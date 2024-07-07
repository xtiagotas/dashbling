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
        Schema::create('anuncios_favoritos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('url_anuncio');
            $table->string('id_anuncio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios_favoritos');
    }
};
