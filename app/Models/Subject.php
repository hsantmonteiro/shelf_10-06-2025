<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'tb_assunto';

    protected $primaryKey = 'id_assunto';

    protected $fillable = ['nm_assunto'];

    public $timestamps = false;

    public function livros()
    {
        return $this->belongsToMany(Book::class, 'tb_livroassunto', 'id_assunto', 'id_livro');
    }
}
