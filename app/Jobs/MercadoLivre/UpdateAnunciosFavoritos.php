<?php

namespace App\Jobs\MercadoLivre;

use App\Models\AnuncioFavorito;
use App\Models\HistoricoAnuncio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateAnunciosFavoritos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $anuncios = AnuncioFavorito::all();
        foreach ($anuncios as $anuncio) {
            $this->fetchAnuncioData($anuncio);
        }
    }

    private function fetchAnuncioData($anuncio)
    {
        $response = Http::get("https://api.mercadolibre.com/items/{$anuncio->id_anuncio}");
        $data = $response->json();

        $soldQuantity = $data['sold_quantity'] ?? 0;
        $visits = $data['visits'] ?? 0;

        // Registrar o histórico diário
        HistoricoAnuncio::create([
            'user_id' => '1',
            'anuncio_favorito_id' => $anuncio->id,
            'data' => now()->toDateString(),
            'quantidade_vendida' => $soldQuantity,
            'visitas' => $visits,
        ]);
    }
}
