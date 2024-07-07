<?php

namespace App\Repositories;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ClienteRepository
{
    public static function clientesNovos($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("pedidos.contato_id, count(pedidos.contato_id) as qtd")
            ->where('pedidos.user_id', $user_id)
            // ->where('count(pedidos.contato_id)', '=', '1')
            // ->where('pedidos.dataSaida', '>', '2021-01-00')
            // ->where('pedidos.dataSaida', '<', '2022-12-32')
            // ->where('pedidos.desconto', '>', '0')
            ->where('sync', '1')
            ->groupBy('pedidos.contato_id')
            // ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }

    public static function clientesRecorrentes($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("pedidos.contato_id, count(pedidos.contato_id) as qtd")
            ->where('pedidos.user_id', $user_id)
            // ->where('count(pedidos.contato_id)', '>', '1')
            // ->where('pedidos.dataSaida', '>', '2021-01-00')
            // ->where('pedidos.dataSaida', '<', '2022-12-32')
            // ->where('pedidos.desconto', '>', '0')
            ->where('sync', '1')
            ->groupBy('pedidos.contato_id')
            // ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }

    public static function clientesQtdVend($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("pedidos.contato_id, count(pedidos.contato_id) as qtd")
            ->where('pedidos.user_id', $user_id)
            // ->where('count(pedidos.contato_id)', '=', '1')
            // ->where('pedidos.dataSaida', '>', '2021-01-00')
            // ->where('pedidos.dataSaida', '<', '2022-12-32')
            // ->where('pedidos.desconto', '>', '0')
            ->where('sync', '1')
            ->groupBy('pedidos.contato_id')
            // ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }
}
