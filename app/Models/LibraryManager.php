<?php

namespace App\Models;

use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LibraryManager extends Model
{
    protected $table = 'tb_gestor_biblioteca';
    public $timestamps = false;

    protected $fillable = ['id_usuario', 'id_biblioteca'];

    public function library()
    {
        return $this->belongsTo(Library::class, 'id_biblioteca');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
