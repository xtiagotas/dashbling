<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    use HasFactory;

    protected $table = 'situacoes';

    protected $fillable = [
        'user_id',
        'bling_id',
        'modulo_id',
        'modulo_descricao',
        'nome',
        'idHerdado',
        'cor'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function pedidos()
    {
        return Pedido::where('situacao_id', $this->bling_id)->get();
    }

    public function notas()
    {
        return Nota::where('situacao_id', $this->bling_id)->get();
    }
    // public function pedidos()
    // {
    //     return $this->hasMany(Pedido::class);
    // }

    // public function notas()
    // {
    //     return $this->hasMany(Nota::class);
    // }
}
