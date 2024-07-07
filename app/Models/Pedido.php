<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'numero',
        'numeroLoja',
        'data',
        'dataSaida',
        'dataPrevista',
        'totalProdutos',
        'total',

        'contato_id',
        'contato_nome',
        'contato_tipoPessoa',

        'situacao_id',
        'situacao_valor',

        'loja_id',
        
        'outrasDespesas',
        'desconto',

        'notaFiscal_id',

        'tributacao_totalICMS',
        'tributacao_totalIPI',

        'transporte_fretePorConta',
        'transporte_frete',

        'transporte_contato_id',
        'transporte_contato_nome',

        'transporte_etiqueta_nome',
        'transporte_etiqueta_municipio',
        'transporte_etiqueta_uf',
        'transporte_etiqueta_cep',

        'taxas_taxaComissao',
        'taxas_custoFrete',
        'taxas_valorBase',

        'vendedor_id', //novo
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function loja()
    {   
        return Loja::where('bling_id', $this->loja_id)->first() ?? new Loja();
        
    }

    public function situacao()
    {   
        return Situacao::where('bling_id', $this->situacao_id)->first() ?? new Situacao();
        
    }

    public function itens()
    {
        return ItemPedido::where('pedido', $this->bling_id)->get();
    }

    // public function itens()
    // {
    //     return $this->hasMany(ItemPedido::class);
    // }

    public function totalFrete()
    {
        return $this->transporte_frete + $this->transporte_fretePorConta;
    }

    public function totalImposto()
    {
        return $this->tributacao_totalICMS + $this->tributacao_totalIPI;
    }

    public function totalCustoProduto()
    {
        return $this->total * 0.6;
    }

    public function totalCusto()
    {
        return $this->totalFrete() + $this->totalImposto() + $this->totalCustoProduto();
    }

    public function totalLiquido()
    {
        return $this->total - ($this->totalFrete + $this->totalImposto);
    }

    public function totalLucro()
    {
        return $this->total - $this->totalCusto();
    }

    public function totalLucroPercent()
    {
        $total = $this->total;
        $lucro = $this->totalLucro();
        $lucroPercent = 0;

        if ($lucro == 0 ) {
            return 0;
        }

        if ($total == 0) {
            $total = 0 - $lucro;
        }

        $lucroPercent = ($lucro / $total) * 100;

       return number_format((float)$lucroPercent, 2, '.', '');
    }
}
