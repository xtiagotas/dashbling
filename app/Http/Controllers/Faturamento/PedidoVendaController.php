<?php

namespace App\Http\Controllers\Faturamento;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Produto;
use App\Repositories\CategoriaRepository;
use App\Repositories\PedidoRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\RegiaoRepository;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class PedidoVendaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        DB::statement("SET lc_time_names = 'pt_BR'");

        /********************************************** */
        // FILTROS VINDOS DO FORMULARIO
        /********************************************** */
        $situacao_id = $request['situacao_id'] ?? '9';
        // return [$request['situacao_id'], $situacao_id];
        $canal_venda_id = $request['canal_venda_id'] ?? '';

        $situacoes_filter = $user->situacoes->where('modulo_id', '=', '98310');
        $lojas_filter = $user->lojas;

        $periodo_de = getDataDe()->format('Y-m-d');
        $periodo_ate = getDataAte()->format('Y-m-d');

        /********************************************** */
        // PEDIDOS DO PERIODO FILTRADO
        /********************************************** */
        $pedidos = Pedido::where('user_id', $user->id)
            ->where('situacao_id', '=', $situacao_id)
            ->where('dataSaida', '>=', $periodo_de)
            ->where('dataSaida', '<=',  $periodo_ate)
            ->get();

        /********************************************** */
        // CARDS SUPERIORES
        /********************************************** */
        $faturamento_bruto = 0;
        $itens_vendidos = 0;

        foreach ($pedidos as $pedido) {
            $faturamento_bruto += $pedido->total;
            foreach ($pedido->itens() as $item) {
                $itens_vendidos += $item->quantidade;
            }
        }

        $pedidos_emitidos = count($pedidos);
        $ticket_medio = ($itens_vendidos == 0) ? 0 : ($faturamento_bruto / $itens_vendidos);

        /********************************************** */
        // PEDIDOS POR DIA
        /********************************************** */
        $pedidos_dias =  DB::table('pedidos')
            ->selectRaw("dataSaida as data, count(dataSaida) as qtd, sum(pedidos.total) as val")
            ->where('pedidos.user_id', $user->id)
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->groupBy('dataSaida')
            ->orderBy('data')
            ->get();

        $fat_dia = [];
        $fat_dia['label'] = [];
        $fat_dia['data'] = [];
        foreach ($pedidos_dias as $dia) {
            $fat_dia['label'][$dia->data] = $dia->data;
            $fat_dia['data'][$dia->data] = $dia->val;
        }

        /********************************************** */
        // CARD DO LUCRO
        /********************************************** */
        $total_frete = 0;
        $total_desconto = 0;
        $total_ICMS = 0;
        $total_IPI = 0;
        $total_prod  = 0;

        foreach ($pedidos as $pedido) {
            $total_frete += $pedido->transporte_frete + $pedido->transporte_fretePorConta;
            $total_desconto += $pedido->desconto;
            $total_ICMS += $pedido->tributacao_totalICMS;
            $total_IPI += $pedido->tributacao_totalIPI;
            foreach ($pedido->itens() as $item) {
                $total_prod += $item->produto()->precoCusto ?? 0;
            }
        }

        //Despesas
        $percent_frete = $faturamento_bruto == 0 ? 0 : ($total_frete / $faturamento_bruto) * 100;
        $percent_desconto = $faturamento_bruto == 0 ? 0 : ($total_desconto / $faturamento_bruto) * 100;

        $percent_prod = $faturamento_bruto == 0 ? 0 : ($total_prod / $faturamento_bruto) * 100;

        $total_impostos = ($total_ICMS + $total_IPI);
        $percent_impostos = $faturamento_bruto == 0 ? 0 : $total_impostos / $faturamento_bruto;

        $total_custos = ($total_impostos + $total_frete + $total_desconto);
        $percent_custos = $faturamento_bruto == 0 ? 0 : ($total_custos / $faturamento_bruto) * 100;

        // Receitas
        $total_liquido = $faturamento_bruto - ($total_impostos + $total_frete + $total_desconto);
        $percet_fat_liquido = $faturamento_bruto == 0 ? 0 : ($total_liquido / $faturamento_bruto) * 100;

        $total_lucro = $total_liquido - $total_prod;
        $percent_lucro = $faturamento_bruto == 0 ? 0 : ($total_lucro / $faturamento_bruto) * 100;

        /********************************************** */
        // TOP CANAIS DE VENDAS
        /********************************************** */
        $lojasx =  DB::table('pedidos')
            ->limit(5)
            ->join('lojas', 'pedidos.loja_id', '=', 'lojas.bling_id')
            ->selectRaw('lojas.tipo, count(pedidos.loja_id) as qtd, sum(pedidos.total) as val')
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->where('lojas.sync', '1')
            ->groupBy('lojas.tipo')
            ->orderBy('val', 'DESC')
            ->get();

        /********************************************** */
        // DESCONTOS POR MESE
        /********************************************** */
        $descontos_meses =  DB::table('pedidos')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as nome, count(DATE_FORMAT(dataSaida, '%b')) as qtd, sum(pedidos.desconto) as val")
            ->where('pedidos.user_id', $user->id)
            // ->where('pedidos.dataSaida', '>', '2021-01-00')
            // ->where('pedidos.dataSaida', '<', '2022-12-32')
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->where('pedidos.desconto', '>', '0')
            ->where('sync', '1')
            ->groupBy(['ano', 'mes', 'nome'])
            ->orderBy('ano')
            ->get();

        /********************************************** */
        // VENDAS POR ESTADOS
        /********************************************** */
        $estados =  DB::table('pedidos')
            ->limit(5)
            ->join('contatos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            ->selectRaw('contatos.endereco_uf, count(contatos.endereco_uf) as qtd, sum(pedidos.total) as val')
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->where('contatos.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->where('contatos.sync', '1')
            ->groupBy('contatos.endereco_uf')
            // ->orderBy('contatos.endereco_uf')
            ->orderBy('val', 'DESC')
            ->get();

        /********************************************** */
        // VENDAS POR CATEGORIAS
        /********************************************** */
        $clientes = DB::table('pedidos')
            ->limit(5)
            ->join('contatos', 'pedidos.contato_id', '=', 'contatos.bling_id')
            ->selectRaw('contatos.bling_id, contatos.nome, count(pedidos.contato_id) as qtd, sum(pedidos.total) as val')
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->where('pedidos.user_id', $user->id)
            ->where('pedidos.sync', '1')
            ->groupBy(['contatos.bling_id', 'contatos.nome'])
            ->orderBy('val', 'DESC')
            ->get();

        /********************************************** */
        // VENDAS POR PRODUTOS
        /********************************************** */
        $produtos = DB::table('itens_pedido')
            ->limit(5)
            ->join('pedidos', 'itens_pedido.pedido', '=', 'pedidos.bling_id')
            ->join('produtos as prd', 'itens_pedido.codigo', '=', 'prd.codigo')
            ->join('produtos as prdPai', 'itens_pedido.codigo', '=', 'prdPai.codigo')
            ->selectRaw('prdPai.codigo as sku, prdPai.nome, sum(itens_pedido.quantidade) as qtd, sum(itens_pedido.quantidade * itens_pedido.valor) as val')
            ->where('situacao_id', '=', $situacao_id)
            ->where('pedidos.dataSaida', '>=', $periodo_de)
            ->where('pedidos.dataSaida', '<=',  $periodo_ate)
            ->where('itens_pedido.user_id', $user->id)
            ->where('itens_pedido.sync', '1')
            ->where('prd.sync', '1')
            ->where('prdPai.sync', '1')
            ->groupBy(['sku', 'prdPai.nome'])
            ->orderBy('val', 'DESC')
            ->get();

        /********************************************** */
        // VENDAS POR CANAIS
        /********************************************** */
        $lojas = DB::table('lojas')
            ->selectRaw("lojas.tipo as tipo")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('situacao_id', '=', $situacao_id)
            ->where('dataSaida', '>=',  $periodo_de)
            ->where('dataSaida', '<=', $periodo_ate)
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy('tipo')
            ->orderBy('tipo')
            ->get();

        $lojas_label = DB::table('lojas')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as dt")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('situacao_id', '=', $situacao_id)
            ->where('dataSaida', '>=',  $periodo_de)
            ->where('dataSaida', '<=', $periodo_ate)
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy(['ano', 'mes', 'dt'])
            ->orderBy('ano')
            ->orderBy('mes')
            ->get();

        $lojas_data = DB::table('lojas')
            ->selectRaw("lojas.tipo as loja, year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as dt, count(DATE_FORMAT(dataSaida, '%b')) as qtd, sum(pedidos.total) as val")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('situacao_id', '=', $situacao_id)
            ->where('dataSaida', '>=',  $periodo_de)
            ->where('dataSaida', '<=', $periodo_ate)
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy(['ano', 'mes', 'loja', 'dt'])
            ->orderBy('ano')
            ->get();

        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return view('faturamento.vendas',
            [
                'formatter' => $formatter,

                'situacoes_filter' => $situacoes_filter,
                'situacao_id' => $situacao_id,

                'lojas_filter' => $lojas_filter,
                'canal_venda_id' => $canal_venda_id,

                // 'periodo_de' => str_replace('-', '/', $periodo_de),
                // 'periodo_ate' => str_replace('-', '/', $periodo_ate),

                'faturamento_bruto' => $faturamento_bruto,
                'pedidos_emitidos' => $pedidos_emitidos,
                'itens_vendidos' => $itens_vendidos,
                'ticket_medio' => $ticket_medio,

                'fat_dia' => $fat_dia,

                'percent_impostos' => $percent_impostos,
                'total_impostos' => $total_impostos,

                'percent_frete' => $percent_frete,
                'total_frete' => $total_frete,

                'percent_desconto' => $percent_desconto,
                'total_descontos' => $total_desconto,

                'percent_prod' => $percent_prod,
                'total_prod' => $total_prod,

                'percent_lucro' => $percent_lucro,
                'total_lucro' => $total_lucro,

                'lojasx' => $lojasx,

                'estados' => $estados,

                'descontos_meses' => $descontos_meses,

                'clientes' => $clientes,

                'produtos' => $produtos,

                'lojas' => $lojas,
                'lojas_data' => $lojas_data,
    
                'lojas_label' => $lojas_label,
            ]
        );
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $user_id = $request->user()->id;
        $pedido_id = $request['venda'];

        $pedido = Pedido::where('user_id', $user_id)->where('numero', $pedido_id)->firstOrFail();
        $itens = $pedido->itens();

        for ($i=0; $i < count($itens); $i++) { 
            $itens[$i]['produto'] = new Produto();

            $produto = Produto::where('bling_id', $itens[$i]->produto)->first();
            if($produto) {
                return 'teste';
                $itens[$i]['produto'] = $produto;
            }            
        }

        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return view('vendas.show', [
            'formatter' => $formatter,
            'pedido' => $pedido,
            'itens' => $itens,
        ]);
    }
}
