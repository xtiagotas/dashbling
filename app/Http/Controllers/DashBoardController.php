<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Repositories\CanalVendaRepository;
use App\Repositories\ClienteRepository;
use App\Repositories\PedidoRepository;
use App\Repositories\SituacaoRepository;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class DashBoardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = new DateTime();
        // $data = new DateTime('2021-09-28');

        DB::statement("SET lc_time_names = 'pt_BR'");

        /********************************* */
        // PEDIDOS HOJE
        /********************************* */
        $pedidos_hoje['pedidos'] = Pedido::select("*")
            ->where('user_id', $user->id)
            ->where('dataSaida', $data->format('Y-m-d'))
            ->where('sync', '1')
            ->get();

        $pedidos_hoje['quantidade'] = count($pedidos_hoje['pedidos']);
        $pedidos_hoje['valor'] = 0;
        foreach ($pedidos_hoje['pedidos'] as $pedido) {
            $pedidos_hoje['valor'] += $pedido->total;
        }

        /********************************* */
        //      PEDIDOS DO MES
        /********************************* */
        $pedidos_mes['pedidos'] = Pedido::select("*")
            ->where('user_id', $user->id)
            ->whereMonth('dataSaida', $data->format('m'))
            ->whereYear('dataSaida', $data->format('Y'))
            ->where('sync', '1')
            ->get();

        $pedidos_mes['quantidade'] = count($pedidos_mes['pedidos']);
        $pedidos_mes['valor'] = 0;
        foreach ($pedidos_mes['pedidos'] as $pedido) {
            $pedidos_mes['valor'] += $pedido->total;
        }

        /********************************* */
        //      PEDIDOS DO ANO
        /********************************* */
        $pedidos_ano['pedidos'] = Pedido::select("*")
            ->where('user_id', $user->id)
            ->whereYear('dataSaida', $data->format('Y'))
            ->where('sync', '1')
            ->get();

        $pedidos_ano['quantidade'] = count($pedidos_ano['pedidos']);
        $pedidos_ano['valor'] = 0;
        foreach ($pedidos_ano['pedidos'] as $pedido) {
            $pedidos_ano['valor'] += $pedido->total;
        }

        /********************************* */
        //      PEDIDOS TODOS
        /********************************* */
        $pedidos_todos['pedidos'] = Pedido::select("*")
            ->where('user_id', $user->id)
            ->where('sync', '1')
            ->get();

        $pedidos_todos['quantidade'] = count($pedidos_todos['pedidos']);
        $pedidos_todos['valor'] = 0;
        foreach ($pedidos_todos['pedidos'] as $pedido) {
            $pedidos_todos['valor'] += $pedido->total;
        }

        /********************************* */
        //      FATURAMENTO ULTIMOS 30 DIAS
        /********************************* */
        $dataMenos30D = new DateTime($data->format('Y-m-d'));
        $dataMenos30D->sub(new DateInterval('P30D'));

        $fat_30dias = DB::table('pedidos')
            ->selectRaw("dataSaida, count(day(dataSaida)) as qtd, sum(pedidos.total) as val")
            ->where('pedidos.user_id', $user->id)
            ->where('dataSaida', '>=', $dataMenos30D->format('Y-m-d'))
            ->where('dataSaida', '<=', $data->format('Y-m-d'))
            ->where('sync', '1')
            ->groupBy('dataSaida')
            ->orderBy('dataSaida')
            ->get();

        /********************************* */
        //      SITUACOES
        /********************************* */
        $situacoes['pedidos'] = DB::table('pedidos')
            ->join('situacoes', 'pedidos.situacao_id', '=', 'situacoes.bling_id')
            ->selectRaw('situacoes.nome, situacoes.cor, count(pedidos.situacao_id) as qtd, sum(pedidos.total) as val')
            ->where('situacoes.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->where('dataSaida', '>=', $dataMenos30D->format('Y-m-d'))
            ->where('dataSaida', '<=', $data->format('Y-m-d'))
            ->where('pedidos.sync', '1')
            ->where('situacoes.sync', '1')
            ->groupBy(['situacoes.nome', 'situacoes.cor'])
            ->orderBy('nome')
            ->get();

        $situacoes['totalPedidos'] = 0;
        foreach ($situacoes['pedidos'] as $pedido) {
            $situacoes['totalPedidos'] += $pedido->qtd;
        }

        /********************************* */
        //      FATURAMENTO Ultimos 12 MESES
        /********************************* */
        $dataMenos12M = new DateTime($data->format('Y-m-d'));
        $dataMenos12M->sub(new DateInterval('P12M'));

        $meses =  DB::table('pedidos')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as nome, sum(pedidos.desconto) as val")
            ->where('pedidos.user_id', $user->id)
            ->where('dataSaida', '>=', $dataMenos12M->format('Y-m-d'))
            ->where('dataSaida', '<=', $data->format('Y-m-d'))
            ->where('sync', '1')
            ->groupBy(['ano', 'mes', 'nome'])
            ->orderBy('ano')
            ->orderBy('mes')
            ->get();

        /********************************* */
        //      FATURAMENTO Últimos 5 anos
        /********************************* */
        $dataMenos5Y = new DateTime($data->format('Y-m-d'));
        $dataMenos5Y->sub(new DateInterval('P5Y'));

        $anos = DB::table('pedidos')
            ->limit(5)
            ->selectRaw('year(dataSaida) as ano, count(year(dataSaida)) as qtd, sum(pedidos.total) as val')
            ->where('pedidos.user_id', $user->id)
            ->where('dataSaida', '>=', $dataMenos5Y->format('Y-m-d'))
            ->where('dataSaida', '<=', $data->format('Y-m-d'))
            ->where('sync', '1')
            ->groupBy("ano")
            ->orderBy("ano")
            ->get();

        /********************************* */
        //      TOP 5 CANAIS DE VENDA
        /********************************* */
        $lojas =  DB::table('pedidos')
            ->limit(5)
            ->join('lojas', 'pedidos.loja_id', '=', 'lojas.bling_id')
            ->selectRaw('lojas.tipo, count(pedidos.loja_id) as qtd, sum(pedidos.total) as val')
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->where('lojas.sync', '1')
            ->groupBy('lojas.tipo')
            ->orderBy('val', 'DESC')
            ->get();

        /********************************* */
        //      Clientes Venda Única vs. Recorrente
        /********************************* */
        $clientes['pedidos'] = DB::table('pedidos')
            ->selectRaw("pedidos.contato_id, count(pedidos.contato_id) as qtd")
            ->where('pedidos.user_id', $user->id)
            ->where('sync', '1')
            ->groupBy('pedidos.contato_id')
            ->get();

        $clientes['vendaUnica'] = 0;
        $clientes['recorrente'] = 0;
        foreach ($clientes['pedidos'] as $cliente) {
            if ($cliente->qtd == 1) {
                $clientes['vendaUnica'] += 1;
            } else if ($cliente->qtd > 1) {
                $clientes['recorrente'] += 1;
            }
        }

        /********************************* */
        //      Top 5 Produtos
        /********************************* */
        $produtos = DB::table('itens_pedido')
            ->limit(5)
            ->join('produtos as prd', 'itens_pedido.codigo', '=', 'prd.codigo')
            ->join('produtos as prdPai', 'itens_pedido.codigo', '=', 'prdPai.codigo')
            ->selectRaw('prdPai.codigo as sku, prdPai.nome, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('itens_pedido.user_id', $user->id)
            ->where('itens_pedido.sync', '1')
            ->where('prd.sync', '1')
            ->where('prdPai.sync', '1')
            ->groupBy(['sku', 'prdPai.nome'])
            ->orderBy('val', 'DESC')
            ->get();


        /********************************* */
        //      Top 5 Regioes
        /********************************* */
        $regioes = DB::table('pedidos')
            ->limit(5)
            ->selectRaw('transporte_etiqueta_uf as uf, count(transporte_etiqueta_uf) as qtd, sum(pedidos.total) as val')
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->groupBy('uf')
            ->orderBy('val', 'DESC')
            ->get();


        return view(
            'dashboard.index',
            [
                'formatter' => new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY),

                'pedidos_hoje' => $pedidos_hoje,
                'pedidos_mes' => $pedidos_mes,
                'pedidos_ano' => $pedidos_ano,
                'pedidos_todos' => $pedidos_todos,

                'fat_30dias' => $fat_30dias,
                'situacoes' => $situacoes,

                'meses' => $meses,
                'anos' => $anos,

                'lojas' => $lojas,
                'clientes' => $clientes,
                'produtos' => $produtos,
                'regioes' => $regioes,
            ]
        );
    }
}
