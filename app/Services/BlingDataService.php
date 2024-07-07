<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\User;
use \DB;

Class BlingDataService
{
    private $bling_token;

    public function __construct(BlingToken $bling_token)
    {
        $this->bling_token = $bling_token;
    }

    public function execute($url)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
        
            CURLOPT_URL => $url,
        
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->bling_token->access_token,
                'Content-Type: application/json',
            ],
        
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
        ]);

        $response = json_decode(curl_exec($ch),true) ?? [];
        curl_close($ch);

        return $response;
    }
}