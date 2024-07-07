<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'tipo',
        'situacao',
        'numero',
        'serie',
        'dataEmissao',
        'dataOperacao',
        'contato_id', //id, nome, tipoPessoa, numeroDocumento
        // 'contato', //id, nome, tipoPessoa, numeroDocumento
        'endereco_uf', //bairro, municipio, uf
        'endereco_municipio', //bairro, municipio, uf
        // 'endereco', //bairro, municipio, uf
        'loja', // id
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    // public function situacao()
    // {   
    //     return $this->belongsTo(Situcao::class);
    // }
}
