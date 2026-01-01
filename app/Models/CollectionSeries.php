<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionSeries extends Model
{
    protected $table = 'tb_serieColecao';
    protected $primaryKey = 'id_serieColecao';
    public $timestamps = false;

    protected $fillable = ['nm_serieColecao'];

    public function livros() {
        return $this->hasMany(Book::class, 'id_serieColecao');
    }
}
