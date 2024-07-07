<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Repositories\DashboardRepository;
use App\Repositories\RegiaoRepository;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaClienteaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // $dataAtual = new DateTime();
        // $dataAtual = new DateTime('2022-09-28');

        // $dataMenos24M = new DateTime($dataAtual->format('Y-m-d'));
        // $dataMenos24M->sub(new DateInterval('P24M'));

        DB::statement("SET lc_time_names = 'pt_BR'");

        $clientes = Auth::user()->clientes;

        /********************************************** */
        // CARDS
        /********************************************** */
        $qtdClientes = count($clientes);
        $mediaPedido = 5;
        $mediaProduto = 3;
        $outros = 1;

        /********************************* */
        //      Clientes Venda Única vs. Recorrente
        /********************************* */
        $clientesx['pedidos'] = DB::table('pedidos')
            ->selectRaw("pedidos.contato_id, count(pedidos.contato_id) as qtd")
            ->where('pedidos.user_id', $user->id)
            ->where('sync', '1')
            ->groupBy('pedidos.contato_id')
            ->get();

        $clientesx['vendaUnica'] = 0;
        $clientesx['recorrente'] = 0;
        foreach ($clientesx['pedidos'] as $cliente) {
            if ($cliente->qtd == 1) {
                $clientesx['vendaUnica'] += 1;
            } else if ($cliente->qtd > 1) {
                $clientesx['recorrente'] += 1;
            }
        }

        /********************************* */
        //      Clientes Pessoa Fisica vs Jurica
        /********************************* */
        $clientesx['fisica'] = 0;
        $clientesx['juridica'] = 0;

        foreach ($clientes as $cliente) {
            if ($cliente->tipo == "J") {
                $clientesx['juridica'] += 1;
            } else {
                $clientesx['fisica'] += 1;
            }
        }

        // return [$clientesx['fisica'], $clientesx['juridica']];

        /********************************************** */
        // ESTADOS
        /********************************************** */
        // $estados =  DB::table('pedidos')
        $estados =  DB::table('contatos')
            ->limit(5)
            // ->join('contatos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            // ->selectRaw('contatos.endereco_uf, count(contatos.endereco_uf) as qtd, sum(pedidos.total) as val')
            ->selectRaw('contatos.endereco_uf, count(contatos.endereco_uf) as qtd')
            ->where('contatos.user_id', $user->id)
            // ->where('pedidos.user_id', $user->id)
            // ->where('pedidos.sync', '1')
            ->where('contatos.sync', '1')
            ->groupBy('contatos.endereco_uf')
            // ->orderBy('contatos.endereco_uf')
            // ->orderBy('val', 'DESC')
            ->orderBy('qtd', 'DESC')
            ->get();


        /********************************************** */
        // TABELA
        /********************************************** */
        $clientes = DB::table('contatos')
            ->join('pedidos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            ->join('itens_pedido', 'itens_pedido.pedido', '=', 'pedidos.bling_id')
            ->selectRaw('contatos.bling_id , contatos.nome, contatos.endereco_uf, endereco_municipio')
            ->selectRaw('count(contatos.bling_id) as qtd_pedidos')
            ->selectRaw('sum(itens_pedido.quantidade) as qtd_produtos')
            ->selectRaw('sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('contatos.user_id', $user->id)
            ->where('contatos.sync', '1')
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->where('itens_pedido.user_id', $user->id)
            ->where('itens_pedido.sync', '1')
            ->groupBy(['contatos.bling_id', 'contatos.nome', 'endereco_uf', 'endereco_municipio'])
            ->orderBy('qtd_pedidos', 'DESC')
            ->get();

        for ($i = 0; $i < count($clientes); $i++) {
            $cliente = $clientes[$i];

            $primeiro_pedido = DB::table('pedidos')->limit(1)
                ->selectRaw('pedidos.*, lojas.tipo, lojas.descricao')
                ->join('lojas', 'lojas.bling_id', '=', 'pedidos.loja_id')
                ->where('pedidos.user_id', $user->id)
                ->where('lojas.user_id', $user->id)
                ->where('contato_id', $cliente->bling_id)
                ->orderBy('dataSaida')
                ->first();

            $ultimo_pedido = DB::table('pedidos')->limit(1)
                ->where('user_id', $user->id)
                ->where('contato_id', $cliente->bling_id)
                ->orderBy('dataSaida', 'DESC')
                ->first();

            // return [$primeiro_pedido];

            $clientes[$i]->origem_cadastro = $primeiro_pedido->tipo ?? '-';
            $clientes[$i]->primeiro_pedido = $primeiro_pedido->dataSaida ?? '-';
            $clientes[$i]->ultimo_pedido = $ultimo_pedido->dataSaida;
            $clientes[$i]->dias_ultima_venda = (new DateTime($ultimo_pedido->dataSaida))->diff(getDataATual())->days;
            // return [$cliente, $primeiro_pedido, $ultimo_pedido];
        }

        // return $clientes;

        return view('clientes.lista-clientes', [
            'clientesx' => $clientesx,
            'clientes' => $clientes,
            'qtdClientes' => $qtdClientes,
            'estados' => $estados,
            'mediaPedido' => $mediaPedido,
            'mediaProduto' => $mediaProduto,
            'outros' => $outros,
        ]);
    }
}
