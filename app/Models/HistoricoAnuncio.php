<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoAnuncio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'anuncio_favorito_id',
        'data',
        'quantidade_vendida',
        'visitas',
    ];

    public function anuncioFavorito()
    {
        return $this->belongsTo(AnuncioFavorito::class);
    }
}
