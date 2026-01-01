<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{

    public function showLibraryData($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $isManager = Auth::check() ? DB::table('tb_gestor_biblioteca')
            ->where('id_usuario', Auth::id())
            ->where('id_biblioteca', $library->id_biblioteca)
            ->exists() : false;

        // Livro mais emprestado

        $mostLoanedBook = $library->books()
            ->whereHas('emprestimos')
            ->withCount('emprestimos')
            ->orderByDesc('emprestimos_count')
            ->first();

        // Número de usuários na biblioteca

        $libraryMembers = $library->readers()
            ->count();

        // Número de livros registrados na biblioteca

        $libraryBooks = $library->books()
            ->count();

        // Livros emprestados por mês - Gráfico

        $loansPerMonth = DB::table('tb_emprestimo')
            ->select(DB::raw("DATE_FORMAT(dt_emprestimo, '%Y-%m') as mes"), DB::raw('count(*) as total'))
            ->where('id_biblioteca', $library->id_biblioteca)
            ->where('dt_emprestimo', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $labelsLoansPerMonth = $loansPerMonth->pluck('mes');
        $dataLoansPerMonth = $loansPerMonth->pluck('total');
        $allLoans = $loansPerMonth->sum('total');

        // Livros emprestados por mês - Gráfico

        $booksPerMonth = DB::table('tb_livro')
            ->select(DB::raw("DATE_FORMAT(dt_registro, '%Y-%m') as mes"), DB::raw('count(*) as total'))
            ->where('id_biblioteca', $library->id_biblioteca)
            ->where('dt_registro', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $labelsBooksPerMonth = $booksPerMonth->pluck('mes');
        $dataBooksPerMonth = $booksPerMonth->pluck('total');

        // Livros mais emprestados - Gráfico

        $mostLoanedBooks = $library->books()
            ->whereHas('emprestimos')
            ->withCount('emprestimos')
            ->orderByDesc('emprestimos_count')
            ->take(10)
            ->get();

        $labelsMostLoanedBooks = $mostLoanedBooks->pluck('nm_livro');
        $dataMostLoanedBooks = $mostLoanedBooks->pluck('emprestimos_count');

        // Usuários com mais empréstimos - Gráfico

        $topMembers = $library->loans()
            ->whereNotNull('dt_devolucao')
            ->selectRaw('id_usuario, COUNT(*) as total')
            ->groupBy('id_usuario')
            ->orderByDesc('total')
            ->with('usuario')
            ->take(10)
            ->get();

        $labelsTopMembers = $topMembers->map(function ($loan) {
            return $loan->usuario->name;
        });

        $dataTopMembers = $topMembers->pluck('total');
        $topMember = $topMembers->first();
        $labelTopMember = optional($topMember->usuario)->name;
        $dataTopMember = $topMember->total ?? 0;

        // Devoluções no prazo - Gráfico

        $loans = $library->loans()->whereNotNull('dt_devolucao_efetiva')->get();

        $onTime = $loans->filter(function ($loan) {
            return $loan->dt_devolucao_efetiva <= $loan->dt_devolucao;
        })->count();

        $late = $loans->count() - $onTime;

        $labelsReturnRate = ['No prazo', 'Com atraso'];
        $dataReturnRate = [$onTime, $late];


        return view('statistics', [
            'library' => $library,
            'mostLoanedBooks' => $mostLoanedBooks,
            'currentLibraryHandle' => $handle,
            'labelsMostLoanedBooks' => $labelsMostLoanedBooks,
            'dataMostLoanedBooks' => $dataMostLoanedBooks,
            'topMembers' => $topMembers,
            'labelsTopMembers' => $labelsTopMembers,
            'dataTopMembers' => $dataTopMembers,
            'topMember' => $topMember,
            'labelTopMember' => $labelTopMember,
            'dataTopMember' => $dataTopMember,
            'labelsReturnRate' => $labelsReturnRate,
            'dataReturnRate' => $dataReturnRate,
            'labelsLoansPerMonth' => $labelsLoansPerMonth,
            'dataLoansPerMonth' => $dataLoansPerMonth,
            'allLoans' => $allLoans,
            'isManager' => $isManager,
            'mostLoanedBook' => $mostLoanedBook,
            'libraryMembers' => $libraryMembers,
            'libraryBooks' => $libraryBooks,
            'labelsBooksPerMonth' => $labelsBooksPerMonth,
            'dataBooksPerMonth' => $dataBooksPerMonth
        ]);
    }

    public function makeBooksReport($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $livros = Book::select('tb_livro.*', DB::raw('COUNT(tb_emprestimo.id_emprestimo) as total_emprestimos'))
            ->join('tb_emprestimo', 'tb_livro.id_livro', '=', 'tb_emprestimo.id_livro')
            ->groupBy('tb_livro.id_livro')
            ->orderByDesc('total_emprestimos')
            ->where('tb_livro.id_biblioteca', $library->id_biblioteca)
            ->take(30)
            ->with([
                'autor',
                'assuntos',
                'editora',
                'idioma',
                'localPublicacao'
            ])
            ->get();

        $pdf = Pdf::loadView('reports/most-loaned-books', compact('livros', 'library'));

        return $pdf->download('livros-mais-emprestados.pdf');
    }

    public function makeUsersReport($handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $topMembers = $library->loans()
            ->whereNotNull('dt_devolucao')
            ->selectRaw('id_usuario, COUNT(*) as total')
            ->groupBy('id_usuario')
            ->orderByDesc('total')
            ->with('usuario')
            ->take(10)
            ->get();

        $pdf = Pdf::loadView('reports/top-users', compact('topMembers', 'library'));

        return $pdf->download('usuarios-mais-ativos.pdf');
    }

    public function makeLoansReport(Request $request, $handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $month = (int) $request->input('month');
        $year = (int) $request->input('year');

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $emprestimos = $library->loans()
            ->with(['livro', 'usuario'])
            ->whereBetween('dt_emprestimo', [$start, $end])
            ->orderBy('dt_emprestimo')
            ->get();

        $pdf = Pdf::loadView('reports/loans-per-month', compact('emprestimos', 'library', 'month', 'year'));

        return $pdf->download("emprestimos-{$month}-{$year}.pdf");
    }

    public function makeStoreReport(Request $request, $handle)
    {
        $library = Library::where('nm_handle', $handle)->firstOrFail();

        $month = (int) $request->input('month');
        $year = (int) $request->input('year');

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $livros = $library->books()
            ->with([
                'autor',
                'assuntos',
                'editora',
                'idioma',
                'localPublicacao'
            ])
            ->whereBetween('dt_registro', [$start, $end])
            ->orderBy('dt_registro')
            ->get();

        $pdf = Pdf::loadView('reports/books-per-month', compact('livros', 'library', 'month', 'year'));

        return $pdf->download("livros-{$month}-{$year}.pdf");
    }
}
