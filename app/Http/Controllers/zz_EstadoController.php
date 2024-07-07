<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $ufs = DB::table('pedidos')
            // ->limit(5)
            // ->join('contatos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            ->selectRaw('pedidos.transporte_etiqueta_uf, count(pedidos.transporte_etiqueta_uf) as qtd, sum(pedidos.total) as val')
            // ->where('contatos.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            // ->where('contatos.sync', '1')
            ->groupBy('pedidos.transporte_etiqueta_uf')
            // ->orderBy('contatos.endereco_uf')
            ->orderBy('val', 'DESC')
            ->get();
        // $lojas = Auth::user()->lojas;

        $qtdUfs = count($ufs);

        return view('estados.index', [
            'ufs' => $ufs,
            'qtdUfs' => $qtdUfs,
        ]);
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $user_id = $request->user()->id;
        $estado_uf = $request['estado'];

        // $uf = Loja::where('user_id', $user_id)->where('bling_id', $estado_uf)->firstOrFail();

        // print_r($loja->descricao);

        return view('estados.show', [
            'estado_uf' => $estado_uf,
            // 'qtdUfs' => $qtdUfs,
        ]);
        return $estado_uf;
    }
}
