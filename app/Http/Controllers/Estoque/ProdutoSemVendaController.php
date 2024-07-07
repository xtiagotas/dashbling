<?php

namespace App\Http\Controllers\Estoque;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class ProdutoSemVendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        DB::statement("SET lc_time_names = 'pt_BR'");

        $produtos = Auth::user()->produtos;

        /********************************************** */
        // PRODUTO NAO VENDIDOS
        /********************************************** */
        $produtosNaoVendidos = [];

        $produtosVendas = ProdutoRepository::produtosVendas($user->id);
        foreach ($produtosVendas as $produtoVenda) {

            if ($produtoVenda->quantidade == 0) {
                if ($produtoVenda->estoque > 0) {
                    $produtosNaoVendidos[] = $produtoVenda;
                }
            }
        }

        return view('estoque.produtos-sem-vendas', [
            'formatter' => new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY),
            'produtosNaoVendidos' => $produtosNaoVendidos,
        ]);
    }
}
