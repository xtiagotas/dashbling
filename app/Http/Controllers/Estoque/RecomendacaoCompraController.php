<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecomendacaoCompraController extends Controller
{
    public function index()
    {
        // Pega a data do primeiro e último dia do mês passado
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $vendasMesPassado = DB::table('itens_pedido')
            ->join('pedidos', 'itens_pedido.pedido', '=', 'pedidos.bling_id')
            ->whereBetween('pedidos.dataSaida', [$lastMonthStart, $lastMonthEnd])
            ->select('itens_pedido.produto', DB::raw('SUM(itens_pedido.quantidade) as total_vendido'))
            ->groupBy('itens_pedido.produto')
            ->get();

        // Convertendo a coleção para array associativo
        $vendasMesPassado = $vendasMesPassado->pluck('total_vendido', 'produto_id')->toArray();

        // Query para recomendar produtos
        $produtos = Produto::where('estoque', '<', 'estoque_minimo')
            ->orWhere(function ($query) use ($vendasMesPassado) {
                foreach ($vendasMesPassado as $produto => $total_vendido) {
                    $query->orWhere(function ($q) use ($produto, $total_vendido) {
                        $q->where('bling_id', $produto)
                            ->where('estoque', '<', $total_vendido);
                    });
                }
            })
            ->get()
            ->map(function ($produto) use ($vendasMesPassado) {
                $total_vendido = $vendasMesPassado[$produto->bling_id] ?? 0;
                $produto->quantidade_recomendada = max($produto->estoque_minimo - $produto->estoque, 0) + $total_vendido;
                $produto->vendas_mes_passado = $total_vendido;
                return $produto;
            });

        return view('estoque.recomendacao-compra', compact('produtos'));
    }
}
