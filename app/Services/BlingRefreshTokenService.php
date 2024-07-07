<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\User;
use App\Services\BlingTokenService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlingRefreshTokenService
{
    private $bling_token;

    public function __construct(BlingToken $bling_token)
    {
        $this->bling_token = $bling_token;
    }

    public function execute()
    {
        $client_id = $this->bling_token->client_id;
        $client_secret = $this->bling_token->client_secret;
        $refresh_token = $this->bling_token->refresh_token;

        $ch = curl_init();

        $URL = 'https://bling.com.br/Api/v3/oauth/token';
        
        curl_setopt_array($ch, [
        
            CURLOPT_URL => $URL,
        
            CURLOPT_POST => true,
        
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode("$client_id:$client_secret"),
                'Content-Type: application/json',
            ],
        
            CURLOPT_POSTFIELDS => json_encode([
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
            ]),
        
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

        //alterar o sync do bling_token aqui ara 1 se 0 e para 2 se 1
        // if ( $this->bling_token->sync == '' ) {
        //     $this->bling_token->sync = '2';
        // } 
        // else if ( $this->bling_token->sync == '2' ) {
        //     $this->bling_token->sync = '1';
        // } 

        $this->bling_token->access_token = $data['access_token'];
        $this->bling_token->token_type = $data['token_type'];
        $this->bling_token->refresh_token = $data['refresh_token'];
        $this->bling_token->save();
    }
}
