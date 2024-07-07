<?php

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class PedidoRepository
{
    public static function pedidosByData($user_id, $data_de, $data_ate)
    {
        return DB::table('pedidos')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as nome, sum(pedidos.desconto) as val")
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.dataSaida', '>=', $data_de)
            ->where('pedidos.dataSaida', '<=', $data_ate)
            ->where('sync', '1')
            ->groupBy(['ano', 'mes', 'nome'])
            ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }

    public static function pedidosByCategoria($user_id)
    {
        return DB::table('itens_pedido')
            ->join('produtos', 'itens_pedido.codigo', '=', 'produtos.codigo')
            ->join('categorias', 'produtos.categoria_id', '=', 'categorias.bling_id')
            ->selectRaw('categorias.bling_id, categorias.descricao, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('itens_pedido.user_id', $user_id)
            // ->where('sync', '1')
            ->groupBy(['categorias.bling_id', 'categorias.descricao'])
            ->orderBy('qtd', 'DESC')
            ->get();
    }

    public static function fatAnualTopFive($user_id)
    {
        return DB::table('pedidos')
            ->limit(5)
            ->selectRaw('year(dataSaida) as ano, count(year(dataSaida)) as qtd, sum(pedidos.total) as val')
            ->where('pedidos.user_id', $user_id)
            ->where('sync', '1')
            ->groupBy("ano")
            ->orderBy("ano")
            ->get();
    }

    public static function fatAnual($user_id)
    {
        return DB::table('pedidos')
            ->limit(5)
            ->selectRaw('year(dataSaida) as ano, count(year(dataSaida)) as qtd, sum(pedidos.total) as val')
            ->where('pedidos.user_id', $user_id)
            ->where('sync', '1')
            ->groupBy("ano")
            ->orderBy("ano")
            ->get();
    }


    public static function fatMensal($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as nome, sum(pedidos.desconto) as val")
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.dataSaida', '>', '2021-01-00')
            ->where('pedidos.dataSaida', '<', '2022-12-32')
            ->where('sync', '1')
            ->groupBy(['ano', 'mes', 'nome'])
            ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }

    public static function descMensal($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as nome, count(DATE_FORMAT(dataSaida, '%b')) as qtd, sum(pedidos.desconto) as val")
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.dataSaida', '>', '2021-01-00')
            ->where('pedidos.dataSaida', '<', '2022-12-32')
            ->where('pedidos.desconto', '>', '0')
            ->where('sync', '1')
            ->groupBy(['ano', 'mes', 'nome'])
            ->orderBy('ano')
            // ->orderBy('ano')
            ->get();
    }

    public static function fatDiario($user_id)
    {
        return DB::table('pedidos')
            ->selectRaw("day(dataSaida) as dia, count(day(dataSaida)) as qtd, sum(pedidos.total) as val")
            ->where('pedidos.user_id', $user_id)
            ->where('pedidos.dataSaida', '>', '2022-02-00')
            ->where('pedidos.dataSaida', '<', '2022-02-32')
            ->where('sync', '1')
            ->groupBy('dia')
            ->orderBy('dia')
            // ->orderBy('ano')
            ->get();
    }

    public static function pedidos($user_id, $situacao_id, $data_de, $data_ate)
    {
        return Pedido::where('user_id', $user_id)
            ->where('situacao_id', '=', $situacao_id)
            ->where('dataSaida', '>=', $data_de)
            ->where('dataSaida', '<=',  $data_ate)
            ->get();

            // $pedidos =  $user->pedidos
            //     ->where('situacao_id', '=', $situacao_id)
            //     ->where('dataSaida', '>=', $periodo_de)
            //     ->where('dataSaida', '<=',  $periodo_ate)
            // ->where('loja_id', '=', $canal_venda_id)
        ;
    }
}
