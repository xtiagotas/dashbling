<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use App\Models\AnuncioFavorito;
use App\Models\HistoricoAnuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AnuncioFavoritoController extends Controller
{
    public function index()
    {
        $anuncios = AnuncioFavorito::where('user_id', Auth::id())->with('historicos')->get();
        return view('mercado-livre.anuncios_favoritos.index', compact('anuncios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_anuncio' => 'required|url',
        ]);

        $idAnuncio = $this->extrairIdAnuncio($request->url_anuncio);

        AnuncioFavorito::create([
            'user_id' => Auth::id(),
            'url_anuncio' => $request->url_anuncio,
            'id_anuncio' => $idAnuncio,
        ]);

        return redirect()->back()->with('success', 'Anúncio adicionado aos favoritos');
    }

    private function extrairIdAnuncio($url)
    {
        // Extrair o ID do anúncio da URL. O ID do anúncio geralmente é a última parte da URL antes dos parâmetros.
        $urlParts = parse_url($url);
        $path = explode('/', $urlParts['path']);
        return $path[count($path) - 1];
    }

    protected function fetchAnuncioData($anuncio)
    {
        $response = Http::get("https://api.mercadolibre.com/items/{$anuncio->id_anuncio}");
        $data = $response->json();

        // Registrar o histórico diário
        HistoricoAnuncio::create([
            'anuncio_favorito_id' => $anuncio->id,
            'data' => now()->toDateString(),
            'quantidade_vendida' => $data['sold_quantity'],
            'visitas' => $data['visits'],
        ]);
    }
}
