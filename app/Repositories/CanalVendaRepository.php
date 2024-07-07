<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Loja;
use Illuminate\Support\Facades\DB;

class CanalVendaRepository
{
    public static function canaisVendas($user_id)
    {
        $canais = Loja::where('user_id', $user_id)->get();
        $total_fat = (DB::table('pedidos')->selectRaw('sum(total) as total_fat')->first())->total_fat;

        for ($i = 0; $i < count($canais); $i++) {

            $pedidos = DB::table('pedidos')
                // ->selectRaw('pedidos.total')
                ->where('pedidos.user_id', $user_id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                // ->groupBy(['quantidade', 'valor'])
                ->get();

            $item_max_first = DB::table('pedidos')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->where('pedidos.user_id', $user_id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                ->orderBy('pedidos.data')
                ->get();

            $item_max_last = DB::table('pedidos')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->where('pedidos.user_id', $user_id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                ->orderBy('pedidos.data', 'DESC')
                ->get();

            foreach ($pedidos as $pedido) {
                $canais[$i]->quantidade += 1;
                $canais[$i]->faturamento += ($pedido->total ?? '0');
            }
            $canais[$i]->primeira_venda = ($item_max_first['0']->data ?? '00/00/0000');
            $canais[$i]->ultima_venda = ($item_max_last['0']->data ?? '00/00/0000');
            $canais[$i]->contribuicao = ( $canais[$i]->faturamento /$total_fat) * 100;
        }

        return $canais;
    }

    public static function topFiveCanais($user_id)
    {
        return DB::table('pedidos')
            ->limit(5)
            ->join('lojas', 'pedidos.loja_id', '=', 'lojas.bling_id')
            ->selectRaw('lojas.tipo, count(pedidos.loja_id) as qtd, sum(pedidos.total) as val')
            ->where('lojas.user_id', $user_id)
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.sync', '1')
            ->where('lojas.sync', '1')
            ->groupBy('lojas.tipo')
            // ->orderBy('lojas.descricao')
            ->orderBy('val', 'DESC')
            ->get();
    }
}
