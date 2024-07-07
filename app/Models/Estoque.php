<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produto_id',
        'deposito_id',
        'saldoFisico',
        'saldoVirtual',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }
}
