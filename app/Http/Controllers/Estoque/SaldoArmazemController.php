<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class SaldoArmazemController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        DB::statement("SET lc_time_names = 'pt_BR'");

        /********************************************** */
        // CARDS
        /********************************************** */
        $estoque_cus = 0;
        $estoque_val = 0;
        $estoque_uni = 0;
        $estoque_luc = 0;

        $produtos = Auth::user()->produtos;
        foreach ($produtos as $produto) {
            $estoque_cus += ($produto->estoque * $produto->precoCusto);
            $estoque_val += ($produto->estoque * $produto->preco);
            $estoque_uni += $produto->estoque;
        }

        $estoque_luc += ($estoque_val - $estoque_cus);

        /********************************************** */
        // DEPÓSITOS
        /********************************************** */
        $estoques = DB::table('estoques')
            // ->join('produtos as prdPai', 'itens_pedido.codigo', '=', 'prdPai.codigo')
            ->join('produtos', 'estoques.produto_id', '=', 'produtos.bling_id')
            ->join('depositos', 'estoques.deposito_id', '=', 'depositos.bling_id')
            // ->selectRaw('prdPai.codigo as sku, prdPai.nome, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            // ->selectRaw('depositos.descricao as deposito, produtos.codigo as sku, produtos.nome, sum(estoques.saldoFisico) as qtd, sum(estoques.saldoFisico * produtos.preco) as val')
            ->selectRaw('depositos.bling_id, depositos.descricao, sum(estoques.saldoFisico) as qtd, sum(estoques.saldoFisico * produtos.preco) as val')
            ->where('estoques.user_id', $user->id)
            // ->where('estoques.sync', '1')
            ->where('produtos.user_id', $user->id)
            ->where('produtos.sync', '1')
            ->where('depositos.user_id', $user->id)
            // ->where('depositos.sync', '1')
            ->groupBy(['bling_id', 'descricao'])
            ->orderBy('val', 'DESC')
            ->get();

        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return view('estoque.saldo-armazem', [
            'formatter' => new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY),
            'estoque_cus' => $formatter->formatCurrency($estoque_cus, 'BRL'),
            'estoque_val' => $formatter->formatCurrency($estoque_val, 'BRL'),
            'estoque_uni' => number_format($estoque_uni, 0, ',', '.'),
            'estoque_luc' => $formatter->formatCurrency($estoque_luc, 'BRL'),

            'estoques' => $estoques
        ]);
    }
}
