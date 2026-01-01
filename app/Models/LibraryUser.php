<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioBiblioteca extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario_biblioteca';

    protected $fillable = [
        'id_usuario',
        'id_biblioteca'
    ];

    public $timestamps = false;
}