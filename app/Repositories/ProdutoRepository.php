<?php

namespace App\Repositories;

use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoRepository
{
    // private $user_id;

    // public function __construct($user_id)
    // {
    //     $this->user_id = $user_id;
    // }

    public static function produtosVendas($user_id)
    {
        $produtos = Produto::where('user_id', $user_id)->get();

        for ($i = 0; $i < count($produtos); $i++) {

            $items = DB::table('itens_pedido')
                // ->limit(1)
                ->selectRaw('sum(itens_pedido.quantidade) as quantidade')
                ->where('itens_pedido.user_id', $user_id)
                ->where('itens_pedido.codigo', $produtos[$i]->codigo)
                ->get();

            $item_max_first = DB::table('itens_pedido')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->join('pedidos', 'itens_pedido.pedido', '=', 'pedidos.bling_id')
                ->where('pedidos.user_id', $user_id)
                ->where('itens_pedido.user_id', $user_id)
                ->where('itens_pedido.codigo', $produtos[$i]->codigo)
                ->orderBy('pedidos.data')
                ->get();

            $item_max_last = DB::table('itens_pedido')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->join('pedidos', 'itens_pedido.pedido', '=', 'pedidos.bling_id')
                ->where('pedidos.user_id', $user_id)
                ->where('itens_pedido.user_id', $user_id)
                ->where('itens_pedido.codigo', $produtos[$i]->codigo)
                ->orderBy('pedidos.data', 'DESC')
                ->get();

            foreach ($items as $item) {
                $produtos[$i]->quantidade += ($item->quantidade ?? '0');
            }
            $produtos[$i]->primeira_venda = ($item_max_first['0']->data ?? '00/00/0000');
            $produtos[$i]->ultima_venda = ($item_max_last['0']->data ?? '00/00/0000');
        }

        return $produtos;
    }

    public static function produtosPorCanalVenda($user_id)
    {
        return DB::table('produtos')->get();

        // return DB::table('itens_pedido')
        //     ->limit(5)
        //     ->join('produtos as prd', 'itens_pedido.codigo', '=', 'prd.codigo')
        //     ->join('produtos as prdPai', 'itens_pedido.codigo', '=', 'prdPai.codigo')
        //     ->selectRaw('prdPai.codigo as sku, prdPai.nome, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
        //     ->where('itens_pedido.user_id', $user_id)
        //     ->where('itens_pedido.sync', '1')
        //     ->where('prd.sync', '1')
        //     ->where('prdPai.sync', '1')
        //     ->groupBy(['sku', 'prdPai.nome'])
        //     ->orderBy('val', 'DESC')
        //     ->get();
    }

    public static function topFiveProd($user_id)
    {
        return DB::table('itens_pedido')
            ->limit(5)
            ->join('produtos as prd', 'itens_pedido.codigo', '=', 'prd.codigo')
            ->join('produtos as prdPai', 'itens_pedido.codigo', '=', 'prdPai.codigo')
            ->selectRaw('prdPai.codigo as sku, prdPai.nome, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('itens_pedido.user_id', $user_id)
            ->where('itens_pedido.sync', '1')
            ->where('prd.sync', '1')
            ->where('prdPai.sync', '1')
            ->groupBy(['sku', 'prdPai.nome'])
            ->orderBy('val', 'DESC')
            ->get();
    }

}
