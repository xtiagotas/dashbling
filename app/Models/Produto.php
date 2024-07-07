<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'user_id',
        'bling_id',
        'idProdutoPai',
        'nome',
        'codigo',
        'preco',
        'tipo', //p = produto; s = serviço
        'situacao', //a = ativo
        'formato', //s = simplese; v = Variacao; e = estrutura
        'descricaoCurta',
        'imagemURL',
        'dataValidade',
        'unidade',
        'pesoLiquido',
        'pesoBruto',
        'volumes',
        'itensPorCaixa',
        'gtin',
        'gtinEmbalagem',
        'tipoProducao',
        'condicao', //0 = novo
        'freteGratis',
        'marca',
        // 'descricaoComplementar',
        // 'linkExterno',
        // 'observacoes',
        // 'descricaoEmbalagemDiscreta',
        'categoria_id',
        'estoque',
        'estoque_minimo',
        'estoque_maximo',
        'estoque_crossdocking',
        'estoque_localizacao',
        // 'actionEstoque',
        'dimensoes_largura',
        'dimensoes_altura',
        'dimensoes_profundidade',
        'dimensoes_unidadeMedida',
        // 'tributacao_origem',
        // 'tributacao_nFCI',
        // 'tributacao_ncm',
        // 'tributacao_cest',
        // 'tributacao_codigoListaServicos',
        // 'tributacao_spedTipoItem',
        // 'tributacao_codigoItem',
        // 'tributacao_percentualTributos',
        // 'tributacao_valorBaseStRetencao',
        // 'tributacao_valorStRetencao',
        // 'tributacao_valorICMSSubstituto',
        // 'tributacao_codigoExcecaoTipi',
        // 'tributacao_classeEnquadramentoIpi',
        // 'tributacao_valorIpiFixo',
        // 'tributacao_codigoSeloIpi',
        // 'tributacao_valorPisFixo',
        // 'tributacao_valorCofinsFixo',
        // 'tributacao_codigoANP',
        // 'tributacao_descricaoANP',
        // 'tributacao_percentualGLP',
        // 'tributacao_percentualGasNacional',
        // 'tributacao_percentualGasImportado',
        // 'tributacao_valorPartida',
        // 'tributacao_tipoArmamento',
        // 'tributacao_descricaoCompletaArmamento',
        // 'tributacao_dadosAdicionais',
        // 'tributacao_grupoProduto_id',
        ///////////////////// REVISAR MIDIA
        // 'midia_video_url',
        // 'midia_imagens_externas_link',
        // 'midia_internas_linkMiniatura_',
        // 'midia_internas_validade',
        // 'midia_internas_ordem',
        // 'midia_internas_anexo_id',
        // 'midia_internas_anexoVinculo_id',
        ///////////////////// FIM REVISAR MIDIA
        // 'linhaProduto_id',
        // 'estrutura_tipoEstoque',
        // 'estrutura_lancamentoEstoque',
        ///////////////////// REVISAR COMPONENTES
        // 'estrutura_componentes_produto_id',
        // 'estrutura_componentes_quantidade',
        ///////////////////// FRIM REVISAR COMPONENTES 
        'precoCusto',
        'precoCompra',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function itensx()
    {
        return ItemPedido::where('produto', $this->bling_id)->get();
    }

    // public function situacao()
    // {   
    //     return $this->belongsTo(Situcao::class);
    // }

    // public function itens()
    // {
    //     return $this->hasMany(ItemPedido::class);
    // }
}
