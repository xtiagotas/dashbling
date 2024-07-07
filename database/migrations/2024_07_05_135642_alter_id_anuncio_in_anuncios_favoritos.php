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
        Schema::table('anuncios_favoritos', function (Blueprint $table) {
            $table->string('id_anuncio', 100)->change();  // Ajustar o tamanho conforme necessário
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios_favoritos', function (Blueprint $table) {
            $table->string('id_anuncio')->change();
        });
    }
};
