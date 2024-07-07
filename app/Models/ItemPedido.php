<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';

    protected $fillable = [
        'user_id',
        'bling_id',
        'pedido',
        'codigo',
        'unidade',
        'quantidade',
        'desconto',
        'valor',
        'aliquotaIPI',
        'descricao',
        'descricaoDetalhada',
        'produto',
        'comisao_base',
        'comisao_aliquota',
        'comisao_valor',
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function pedido()
    {   
        return Pedido::where('situacao_id', $this->bling_id)->get();
    }

    public function produto()
    {
        return Produto::where('bling_id', $this->produto)->first();
    }

    // public function pedido()
    // {   
    //     return $this->belongsTo(Pedido::class);
    // }

    // public function produto()
    // {
    //     return $this->belongsTo(Produto::class);
    // }
}
