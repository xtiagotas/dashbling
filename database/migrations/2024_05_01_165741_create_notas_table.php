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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('bling_id');
            $table->string('tipo');
            $table->string('situacao');
            $table->string('numero');
            $table->string('serie');
            $table->string('dataEmissao');
            $table->string('dataOperacao');
            $table->string('contato_id');
            $table->string('endereco_uf');
            $table->string('endereco_municipio');
            $table->string('loja');

            $table->string('sync');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
