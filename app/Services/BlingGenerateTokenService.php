<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\User;
use \DB;

Class BlingGenerateTokenService
{
    private $bling_token;
    private $code;

    public function __construct(BlingToken $bling_token, $code)
    {
        $this->bling_token = $bling_token;
        $this->code = $code;
    }

    public function execute()
    {
        $client_id = $this->bling_token->client_id;
        $client_secret = $this->bling_token->client_secret;
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
                'grant_type' => 'authorization_code',
                'code' => $this->code,
            ]),
        
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $data = json_decode(curl_exec($ch),true);
        curl_close($ch);

        $this->bling_token->access_token = $data['access_token'];
        $this->bling_token->token_type = $data['token_type'];
        $this->bling_token->refresh_token = $data['refresh_token'];
        $this->bling_token->save();

        return $this->bling_token;
    }

}