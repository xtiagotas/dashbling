<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'descricao',
        'tipoIntegracao',
        'integracaoNativa',
        'situacao',
        'integracao_id',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }
}
