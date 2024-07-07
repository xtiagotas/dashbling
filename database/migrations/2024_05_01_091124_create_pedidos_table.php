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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('bling_id');
            $table->string('numero');
            $table->string('numeroLoja');
            $table->string('data');
            $table->string('dataSaida');
            $table->string('dataPrevista');
            $table->string('totalProdutos');
            $table->string('total');

            $table->string('contato_id');
            $table->string('contato_nome');
            $table->string('contato_tipoPessoa');

            $table->string('situacao_id');
            $table->string('situacao_valor');

            $table->string('loja_id');

            $table->string('outrasDespesas')->nullable();
            $table->string('desconto')->nullable();

            $table->string('notaFiscal_id')->nullable();

            $table->string('tributacao_totalICMS')->nullable();
            $table->string('tributacao_totalIPI')->nullable();
            
            $table->string('transporte_fretePorConta')->nullable();
            $table->string('transporte_frete')->nullable();

            $table->string('transporte_contato_id')->nullable();
            $table->string('transporte_contato_nome')->nullable();

            $table->string('transporte_etiqueta_nome')->nullable();
            $table->string('transporte_etiqueta_municipio')->nullable();
            $table->string('transporte_etiqueta_uf')->nullable();
            $table->string('transporte_etiqueta_cep')->nullable();

            $table->string('taxas_taxaComissao')->nullable();
            $table->string('taxas_custoFrete')->nullable();
            $table->string('taxas_valorBase')->nullable();

            $table->string('vendedor_id')->nullable() ;
            
            $table->string('sync');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
