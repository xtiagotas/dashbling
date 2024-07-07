<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('bling_id');
            $table->string('idProdutoPai');
            $table->string('nome');
            $table->string('codigo');
            $table->string('preco');
            $table->string('tipo');
            $table->string('situacao');
            $table->string('formato');
            $table->text('descricaoCurta');
            $table->string('imagemURL');
            $table->string('dataValidade');
            $table->string('unidade');
            $table->string('pesoLiquido');
            $table->string('pesoBruto');
            $table->string('volumes');
            $table->string('itensPorCaixa');
            $table->string('gtin');
            $table->string('gtinEmbalagem');
            $table->string('tipoProducao');
            $table->string('condicao'); //0 = novo
            $table->string('freteGratis');
            $table->string('marca');
            // $table->string('descricaoComplementar');
            // $table->string('linkExterno');
            // $table->string('observacoes');
            // $table->string('descricaoEmbalagemDiscreta');
            $table->string('categoria_id');
            $table->string('estoque');
            $table->string('estoque_minimo');
            $table->string('estoque_maximo');
            $table->string('estoque_crossdocking');
            $table->string('estoque_localizacao');
            // $table->string('actionEstoque');
            $table->string('dimensoes_largura');
            $table->string('dimensoes_altura');
            $table->string('dimensoes_profundidade');
            $table->string('dimensoes_unidadeMedida');
            // $table->string('tributacao_origem');
            // $table->string('tributacao_nFCI');
            // $table->string('tributacao_ncm');
            // $table->string('tributacao_cest');
            // $table->string('tributacao_codigoListaServicos');
            // $table->string('tributacao_spedTipoItem');
            // $table->string('tributacao_codigoItem');
            // $table->string('tributacao_percentualTributos');
            // $table->string('tributacao_valorBaseStRetencao');
            // $table->string('tributacao_valorStRetencao');
            // $table->string('tributacao_valorICMSSubstituto');
            // $table->string('tributacao_codigoExcecaoTipi');
            // $table->string('tributacao_classeEnquadramentoIpi');
            // $table->string('tributacao_valorIpiFixo');
            // $table->string('tributacao_codigoSeloIpi');
            // $table->string('tributacao_valorPisFixo');
            // $table->string('tributacao_valorCofinsFixo');
            // $table->string('tributacao_codigoANP');
            // $table->string('tributacao_descricaoANP');
            // $table->string('tributacao_percentualGLP');
            // $table->string('tributacao_percentualGasNacional');
            // $table->string('tributacao_percentualGasImportado');
            // $table->string('tributacao_valorPartida');
            // $table->string('tributacao_tipoArmamento');
            // $table->string('tributacao_descricaoCompletaArmamento');
            // $table->string('tributacao_dadosAdicionais');
            // $table->string('tributacao_grupoProduto_id');
              ///////////////////// REVISAR MIDIA
            // $table->string('midia_video_url');
            // $table->string('midia_imagens_externas_link');
            // $table->string('midia_internas_linkMiniatura_');
            // $table->string('midia_internas_validade');
            // $table->string('midia_internas_ordem');
            // $table->string('midia_internas_anexo_id');
            // $table->string('midia_internas_anexoVinculo_id');
              ///////////////////// FIM REVISAR MIDIA
            // $table->string('linhaProduto_id');
            // $table->string('estrutura_tipoEstoque');
            // $table->string('estrutura_lancamentoEstoque');
              ///////////////////// REVISAR COMPONENTES
            // $table->string('estrutura_componentes_produto_id');
            // $table->string('estrutura_componentes_quantidade');
              ///////////////////// FRIM REVISAR COMPONENTES   
            $table->string('precoCusto');
            $table->string('precoCompra');
            $table->string('sync');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
