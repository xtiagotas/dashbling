<?php

namespace App\Repositories;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class RegiaoRepository
{
    public static function topFiveUf($user_id)
    {
        return DB::table('pedidos')
            ->limit(5)
            ->join('contatos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            ->selectRaw('contatos.endereco_uf, count(contatos.endereco_uf) as qtd, sum(pedidos.total) as val')
            ->where('contatos.user_id', $user_id)
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.sync', '1')
            ->where('contatos.sync', '1')
            ->groupBy('contatos.endereco_uf')
            // ->orderBy('contatos.endereco_uf')
            ->orderBy('val', 'DESC')
            ->get();
    }
}