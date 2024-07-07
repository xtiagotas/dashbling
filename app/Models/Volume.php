<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'servico',
        'codigoRastreamento',
        'sync'
    ];
}
