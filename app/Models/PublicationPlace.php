<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationPlace extends Model
{
    protected $table = 'tb_localpublicacao';
    protected $primaryKey = 'id_localPublicacao';
    public $timestamps = false;

    protected $fillable = ['nm_localPublicacao'];

    public function livros() {
        return $this->hasMany(Book::class, 'id_localPublicacao');
    }
}
