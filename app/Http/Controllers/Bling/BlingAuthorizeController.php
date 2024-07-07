<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlingToken;
use App\Services\BlingGenerateTokenService;

class BlingAuthorizeController extends Controller
{
    public function index(Request $request)
    {
        $bling_token = $request->user()->bling_token;
        $code = $request->code;

        $blingGenerateTokenService = new BlingGenerateTokenService($bling_token, $code);
        $blingGenerateTokenService->execute();

        $msg ='Bling integrado com sucesso!';

        return view('authorize', ['msg' => $msg]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $bling_token = $user->bling_token;

        $bling_token->client_id = $request->client_id;
        $bling_token->client_secret = $request->client_secret;
        $bling_token->save();
        
        return redirect('https://www.bling.com.br/Api/v3/oauth/authorize?response_type=code&client_id='.$request->client_id.'&state=a9f296ae242483dc283890a0f788dc4b');
    }
}
