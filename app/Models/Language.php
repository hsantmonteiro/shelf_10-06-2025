<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'tb_idioma';
    protected $primaryKey = 'id_idioma';
    public $timestamps = false;

    protected $fillable = ['nm_idioma'];

    public function livros() {
        return $this->hasMany(Book::class, 'id_idioma');
    }
}
