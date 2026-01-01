<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function showLendForm(Library $library, $id)
    {

        $livro = Book::findOrFail($id);
        $bookLibrary = $livro->id_biblioteca;

        if ($bookLibrary !== $library->id_biblioteca) {
            return redirect()->route('books.showLendForm', [
                'library' => $library->nm_handle,
                'book' => $id
            ]);
        }

        $usuariosComLimite = DB::table('tb_emprestimo')
            ->join('tb_livro', 'tb_emprestimo.id_livro', '=', 'tb_livro.id_livro')
            ->where('tb_livro.id_biblioteca', $library->id_biblioteca)
            ->where('tb_emprestimo.fl_devolvido', false)
            ->groupBy('tb_emprestimo.id_usuario')
            ->havingRaw('COUNT(*) >= ?', [$library->qt_limite_emprestimos])
            ->pluck('tb_emprestimo.id_usuario')
            ->toArray();

        // 2. Obter apenas usuários que são membros desta biblioteca
        $usuariosMembros = DB::table('tb_usuario_biblioteca')
            ->where('id_biblioteca', $library->id_biblioteca)
            ->pluck('id_usuario')
            ->toArray();

        // 3. Combinar os filtros
        $usuarios = User::whereIn('id', $usuariosMembros)
            ->whereNotIn('id', $usuariosComLimite)
            ->get();

        return view('lend-book', [
            'livro' => $livro,
            'usuarios' => $usuarios,
            'library' => $library,
            'currentLibraryHandle' => $library->nm_handle
        ]);
    }

    protected function somarDiasUteis($data, $dias)
    {
        $diasSomados = 0;
        while ($diasSomados < $dias) {
            $data->addDay();
            if (!$data->isWeekend()) {
                $diasSomados++;
            }
        }
        return $data;
    }


    public function lend(Request $request, $id_livro)
    {
        Log::info("Iniciando empréstimo do livro ID {$id_livro} por usuário {$request->id_usuario}");

        $livro = Book::findOrFail($id_livro);
        $library = $livro->library;

        Log::info("Livro localizado: {$livro->nm_livro} | Biblioteca: {$library->nm_biblioteca}");

        $request->validate([
            'id_usuario' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) use ($library) {
                    $totalEmprestimos = DB::table('tb_emprestimo')
                        ->join('tb_livro', 'tb_emprestimo.id_livro', '=', 'tb_livro.id_livro')
                        ->where('tb_emprestimo.id_usuario', $value)
                        ->where('tb_livro.id_biblioteca', $library->id_biblioteca)
                        ->where('tb_emprestimo.fl_devolvido', 0)
                        ->count();

                    Log::info("Usuário {$value} tem {$totalEmprestimos} empréstimos ativos na biblioteca ID {$library->id_biblioteca}");

                    if ($totalEmprestimos >= $library->qt_limite_emprestimos) {
                        Log::warning("Usuário {$value} excedeu o limite de empréstimos");
                        $fail("Este usuário já possui {$library->qt_limite_emprestimos} empréstimos ativos nesta biblioteca.");
                    }
                }
            ],
        ]);

        $diasDevolucao = $library->qt_dias_devolucao;
        $usarDiasUteis = $library->fl_dias_uteis;

        $dataHoje = Carbon::now();
        $dataDevolucao = $usarDiasUteis
            ? $this->somarDiasUteis($dataHoje, $diasDevolucao)
            : $dataHoje->copy()->addDays($diasDevolucao);

        DB::table('tb_emprestimo')->insert([
            'id_usuario' => $request->id_usuario,
            'id_livro' => $id_livro,
            'dt_devolucao' => $dataDevolucao->format('Y-m-d'),
            'id_biblioteca' => $library->id_biblioteca,
            'fl_devolvido' => 0
        ]);

        Log::info("Empréstimo registrado: livro ID {$id_livro}, usuário ID {$request->id_usuario}, devolução em {$dataDevolucao->format('Y-m-d')}");

        $livro->nr_exemplar -= 1;
        if ($livro->nr_exemplar == 0) {
            $livro->fl_disponivel = false;
            Log::info("Livro ID {$livro->id_livro} ficou indisponível após este empréstimo.");
        }
        $livro->save();

        Log::info("Finalizado empréstimo com sucesso.");

        return redirect()
            ->route('book', ['book' => $livro->id_livro])
            ->with('success', 'Empréstimo registrado com sucesso.');
    }


    public function showDevolutionTable($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $isManager = Auth::check() ? DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $library->id_biblioteca)
            ->exists() : false;

        $emprestimosPendentes = Loan::with(['usuario', 'livro', 'library'])
            ->where('id_biblioteca', $library->id_biblioteca)
            ->where('fl_devolvido', false)
            ->where('dt_devolucao', '>=', now())
            ->get();

        $emprestimosAtrasados = Loan::with(['usuario', 'livro', 'library'])
            ->where('id_biblioteca', $library->id_biblioteca)
            ->where('fl_devolvido', false)
            ->where('dt_devolucao', '<', now())
            ->get()
            ->each(function ($emprestimo) {
                Log::info("Dados do empréstimo ID: {$emprestimo->id_emprestimo}", [
                    'biblioteca_id' => $emprestimo->id_biblioteca,
                    'multa_calculada' => $emprestimo->multa
                ]);
            });

        return view('devolutions', [
            'emprestimosPendentes' => $emprestimosPendentes,
            'emprestimosAtrasados' => $emprestimosAtrasados,
            'isManager' => $isManager,
            'library' => $library,
            'currentLibraryHandle' => $handle
        ]);
    }

    public function devolute($id_emprestimo)
    {
        $emprestimo = Loan::findOrFail($id_emprestimo);

        // Atualiza o status e a data de devolução
        $emprestimo->update([
            'fl_devolvido' => true,
            'dt_devolucao_efetiva' => Carbon::now()
        ]);

        // Incrementa o número de exemplares disponíveis
        $livro = $emprestimo->livro;
        $livro->nr_exemplar += 1;

        // Se estava indisponível, marca como disponível novamente
        if ($livro->nr_exemplar > 0 && !$livro->fl_disponivel) {
            $livro->fl_disponivel = true;
        }

        $livro->save();

        return back()->with('success', 'Livro devolvido com sucesso!');
    }
}
