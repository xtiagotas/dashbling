<?php

namespace App\Repositories;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaRepository
{
    public static function topFiveCat($user_id)
    {
        return DB::table('itens_pedido')
            ->limit(5)
            ->join('produtos', 'itens_pedido.codigo', '=', 'produtos.codigo')
            ->join('categorias', 'produtos.categoria_id', '=', 'categorias.bling_id')
            ->selectRaw('categorias.bling_id, categorias.descricao, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('itens_pedido.user_id', $user_id)
            ->where('itens_pedido.sync', '1')
            ->where('produtos.sync', '1')
            ->where('categorias.sync', '1')
            ->groupBy(['categorias.bling_id', 'categorias.descricao'])
            ->orderBy('val', 'DESC')
            ->get();
    }

}
