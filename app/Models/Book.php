<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'tb_livro';
    protected $primaryKey = 'id_livro';
    public $timestamps = false;
    protected $dates = ['dt_registro'];
    use HasFactory;

    protected $fillable = [
        'nm_livro',
        'ds_cutter',
        'ds_cdd',
        'ds_isbn',
        'nr_anoPublicacao',
        'ds_sinopse',
        'id_idioma',
        'id_editora',
        'id_autor',
        'id_localPublicacao',
        'id_serieColecao',
        'nr_exemplar',
        'nr_edicao',
        'nr_volume',
        'ds_observacao',
        'id_biblioteca',
        'dt_registro',
        'photo_name',
        'photo_path',
        'photo_size',
        'ds_fixado',
    ];


    public function library()
    {
        return $this->belongsTo(Library::class, 'id_biblioteca');
    }

    public function autor()
    {
        return $this->belongsTo(Author::class, 'id_autor');
    }

    public function editora()
    {
        return $this->belongsTo(Publisher::class, 'id_editora');
    }

    public function idioma()
    {
        return $this->belongsTo(Language::class, 'id_idioma');
    }

    public function localPublicacao()
    {
        return $this->belongsTo(publicationPlace::class, 'id_localPublicacao');
    }

    public function serieColecao()
    {
        return $this->belongsTo(CollectionSeries::class, 'id_serieColecao');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Subject::class, 'tb_livroassunto', 'id_livro', 'id_assunto');
    }

    public function emprestimos()
    {
        return $this->hasMany(Loan::class, 'id_livro');
    }

    public function emprestimosAtivos()
    {
        return $this->hasMany(Loan::class, 'id_livro')->where('fl_devolvido', 0);
    }
}

