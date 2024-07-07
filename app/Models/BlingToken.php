<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlingToken extends Model
{
    use HasFactory;

    protected $table = 'bling_tokens';

    protected $fillable = [
        'user_id',
        'client_id',
        'client_secret',
        'access_token',
        'token_type',
        'refresh_token',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    // public function generateToken($code)
    // {
    //     $blingService = new \App\Services\BlingService();
    //     $data = $blingService->getToken($this->client_id, $this->client_secret, $code);
    //     $this->access_token = $data['access_token'];
    //     $this->token_type = $data['token_type'];
    //     $this->refresh_token = $data['refresh_token'];
    //     $this->save();
    // }

    // public function refreshToken()
    // {
    //     $blingService = new \App\Services\BlingService();
    //     $data = $blingService->getRefreshToken($this->client_id, $this->client_secret, $this->refresh_token);
    //     $this->access_token = $data['access_token'] ?? '';
    //     $this->token_type = $data['token_type'] ?? '';
    //     $this->refresh_token = $data['refresh_token'] ?? '';
    //     $this->save();
    // }
}
