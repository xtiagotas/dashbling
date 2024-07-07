<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bling_id',
        'descricao',
        'categoriaPai',
        'sync'
    ];

    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return Produto::where('categoria_id', $this->bling_id)->get();
    }
}
