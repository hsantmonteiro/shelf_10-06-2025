<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'tb_emprestimo';
    protected $primaryKey = 'id_emprestimo';
    public $timestamps = false;
    protected $appends = ['multa'];

    protected $fillable = ['id_usuario', 'id_livro', 'dt_devolucao', 'dt_emprestimo', 'fl_devolvido', 'dt_devolucao_efetiva', 'id_biblioteca'];

    public function livro()
    {
        return $this->belongsTo(Book::class, 'id_livro');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function library()
    {
        return $this->belongsTo(Library::class, 'id_biblioteca');
    }

    public function calcularMulta()
    {
        $library = DB::table('tb_biblioteca')
            ->where('id_biblioteca', $this->id_biblioteca)
            ->first();

        if (!$library || $library->vl_multa <= 0) {
            return 0;
        }

        $dataPrevista = Carbon::parse($this->dt_devolucao);
        $dataDevolucao = Carbon::now()->startOfDay();;

        // Corrige o cálculo: inverta a ordem das datas e remova o parâmetro `false`
        $diasAtraso = $dataPrevista->diffInDays($dataDevolucao, false);

        return max(0, $diasAtraso) * $library->vl_multa;
    }

    public function getMultaAttribute()
    {
        $multa = $this->calcularMulta();
        Log::info("Multa calculada para empréstimo {$this->id_emprestimo}: {$multa}");
        return $multa;
    }
}
