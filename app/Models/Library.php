<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LibraryManager;

class Library extends Model
{
    use HasFactory;

    protected $table = 'tb_biblioteca';
    protected $primaryKey = 'id_biblioteca';

    protected $fillable = [
        'nm_biblioteca',
        'nm_handle',
        'ds_descricao',
        'vl_multa',
        'qt_dias_devolucao',
        'fl_dias_uteis',
        'qt_limite_emprestimos',
        'photo_name',
        'photo_path',
        'photo_size'
    ];

    public $timestamps = false;

    public function gestores()
    {
        return $this->hasMany(LibraryManager::class, 'id_biblioteca');
    }


    public function readers()
    {
        return $this->belongsToMany(User::class, 'tb_usuario_biblioteca', 'id_biblioteca', 'id_usuario');
    }

    public function getRouteKeyName()
    {
        return 'nm_handle';
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'id_biblioteca');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'id_biblioteca');
    }
}
