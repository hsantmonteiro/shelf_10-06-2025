<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'tb_editora';
    protected $primaryKey = 'id_editora';
    public $timestamps = false;

    protected $fillable = ['nm_editora'];

    public function livros() {
        return $this->hasMany(Book::class, 'id_editora');
    }
}
