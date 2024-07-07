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
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            // $table->foreignIdFor(\App\Models\Pedido::class)->constrained();
            // $table->foreignIdFor(\App\Models\Produto::class)->constrained();
            $table->string('bling_id');
            $table->string('pedido');
            $table->string('codigo');
            $table->string('unidade');
            $table->string('quantidade');
            $table->string('desconto');
            $table->string('valor');
            $table->string('aliquotaIPI');
            $table->string('descricao');
            $table->string('descricaoDetalhada');
            $table->string('produto');
            $table->string('sync');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_pedido');
    }
};
