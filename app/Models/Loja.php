<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'descricao',
        'tipo',
        'situacao',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }
}
