<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'tb_autor';
    protected $primaryKey = 'id_autor';
    public $timestamps = false;

    protected $fillable = ['nm_autor'];

    public function livros() {
        return $this->hasMany(Book::class, 'id_autor');
    }
}
