<?php

namespace App\Http\Controllers\Estoque;


use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class ProdutoVendidoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        DB::statement("SET lc_time_names = 'pt_BR'");

        /********************************************** */
        // PRODUTO VENDIDOS
        /********************************************** */
        $produtoVendidos = [];

        $produtosVendas = ProdutoRepository::produtosVendas($user->id);
        foreach ($produtosVendas as $produtoVenda) {

            if ($produtoVenda->quantidade > 0) {
                // $produto->preco == '0' ? '0' : number_format((($produto->preco - $produto->precoCusto) / $produto->preco) * 100, 2)
                $produtoVenda->margem = $produtoVenda->preco == '0' ? '0' : ((($produtoVenda->preco - $produtoVenda->precoCusto) / $produtoVenda->preco) * 100);
                $produtoVendidos[] = $produtoVenda;
            }
        }

        return view('estoque.produtos-vendidos', [
            'formatter' => new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY),
            'produtoVendidos' => $produtoVendidos,
        ]);
    }
}
