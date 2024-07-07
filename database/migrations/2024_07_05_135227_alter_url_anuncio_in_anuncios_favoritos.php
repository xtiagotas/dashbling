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
            $table->text('url_anuncio')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios_favoritos', function (Blueprint $table) {
            $table->string('url_anuncio', 255)->change();
        });
    }
};
