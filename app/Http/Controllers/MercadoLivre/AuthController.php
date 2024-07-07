<?php

namespace App\Http\Controllers\MercadoLivre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function redirectToAuth()    
    {
        $codeVerifier = $this->generateCodeVerifier();
        $codeChallenge = $this->generateCodeChallenge($codeVerifier);

        Session::put('code_verifier', $codeVerifier);

        // $clientId = config('services.mercadolivre.client_id');
        // $redirectUri = config('services.mercadolivre.redirect_uri');
        // $scope = 'read write';
        $clientId = env('MERCADO_LIVRE_CLIENT_ID');
        $redirectUri = route('mercadolivre.callback');
        $scope = 'read write';

        // print_r($redirectUri);
        // die();

        $url = "https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}&scope={$scope}&code_challenge={$codeChallenge}&code_challenge_method=S256";

        return redirect($url);
    }

    public function handleCallback(Request $request)
    {
        $code = $request->get('code');
        $codeVerifier = Session::get('code_verifier');

        $response = Http::asForm()->post('https://api.mercadolibre.com/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.mercadolivre.client_id'),
            'client_secret' => config('services.mercadolivre.client_secret'),
            'code' => $code,
            'redirect_uri' => config('services.mercadolivre.redirect_uri'),
            'code_verifier' => $codeVerifier,
        ]);

        $accessToken = $response->json()['access_token'];
        $refreshToken = $response->json()['refresh_token'];

        // Salvar tokens no banco de dados ou sessão
        // Por exemplo:
        // Auth::user()->update([
        //     'mercado_livre_access_token' => $accessToken,
        //     'mercado_livre_refresh_token' => $refreshToken,
        // ]);

        return redirect()->route('dashboard');
    }

    private function generateCodeVerifier($length = 128)
    {
        return bin2hex(random_bytes($length / 2));
    }

    private function generateCodeChallenge($codeVerifier)
    {
        return rtrim(strtr(base64_encode(hash('sha256', $codeVerifier, true)), '+/', '-_'), '=');
    }
}
