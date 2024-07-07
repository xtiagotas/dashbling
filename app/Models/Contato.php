<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'nome',
        'codigo',
        'situacao',
        // 'numeroDocumento',
        // 'telefone',
        // 'celular',
        'fantasia',
        'tipo',
        'endereco_uf',
        'endereco_municipio',
        // 'dadosAdicionais_dataNascimento',
        // 'dadosAdicionais_sexo',
        // 'dadosAdicionais_naturalidade',
        // 'tiposContato_id',
        // 'tiposContato_descricao',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function pedidos()
    {
        return Pedido::where('contato_id', $this->bling_id)->get();
    }
}
