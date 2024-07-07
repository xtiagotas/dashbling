<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedores';

    protected $fillable = [
        'user_id',
        'bling_id',
        'descontoLimite',
        'loja_id',
        'contato_id',
        'contato_nome',
        'contato_situacao',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }
}
