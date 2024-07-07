<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnuncioFavorito extends Model
{
    use HasFactory;

    protected $table = 'anuncios_favoritos';

    protected $fillable = [
        'user_id',
        'url_anuncio',
        'id_anuncio',
    ];

    public function historicos()
    {
        return $this->hasMany(HistoricoAnuncio::class);
    }
}
