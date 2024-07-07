<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Repositories\CanalVendaRepository;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class CanalVendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dataAtual = new DateTime();
        // $dataAtual = new DateTime('2022-09-28');

        $dataMenos24M = new DateTime($dataAtual->format('Y-m-d'));
        $dataMenos24M->sub(new DateInterval('P24M'));

        DB::statement("SET lc_time_names = 'pt_BR'");

        /********************************************** */
        // VENDAS POR CANAIS
        /********************************************** */
        $lojas = DB::table('lojas')
            ->selectRaw("lojas.tipo as tipo")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('dataSaida', '>=',  $dataMenos24M->format('Y-m-d'))
            ->where('dataSaida', '<=', $dataAtual->format('Y-m-d'))
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy('tipo')
            ->orderBy('tipo')
            ->get();

        $lojas_label = DB::table('lojas')
            ->selectRaw("year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as dt")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('dataSaida', '>=',  $dataMenos24M->format('Y-m-d'))
            ->where('dataSaida', '<=', $dataAtual->format('Y-m-d'))
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy(['ano', 'mes', 'dt'])
            ->orderBy('ano')
            ->orderBy('mes')
            ->get();

        $lojas_data = DB::table('lojas')
            ->selectRaw("lojas.tipo as loja, year(dataSaida) as ano, month(dataSaida) as mes, CONCAT(DATE_FORMAT(dataSaida, '%b'), ' ', year(dataSaida)) as dt, count(DATE_FORMAT(dataSaida, '%b')) as qtd, sum(pedidos.total) as val")
            ->join('pedidos', 'pedidos.loja_id', 'lojas.bling_id')
            ->where('dataSaida', '>=',  $dataMenos24M->format('Y-m-d'))
            ->where('dataSaida', '<=', $dataAtual->format('Y-m-d'))
            ->where('lojas.user_id', $user->id)
            ->where('pedidos.user_id', $user->id)
            ->groupBy(['ano', 'mes', 'loja', 'dt'])
            ->orderBy('ano')
            ->get();

        /********************************************** */
        // CANAIS MAIS VENDIDOS
        /********************************************** */
        $canaisMaisVendidos = [];

        $canais = Loja::where('user_id', $user->id)->get();
        $total_fat = (DB::table('pedidos')->selectRaw('sum(total) as total_fat')->first())->total_fat;

        for ($i = 0; $i < count($canais); $i++) {

            $pedidos = DB::table('pedidos')
                // ->selectRaw('pedidos.total')
                ->where('pedidos.user_id', $user->id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                // ->groupBy(['quantidade', 'valor'])
                ->get();

            $item_max_first = DB::table('pedidos')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->where('pedidos.user_id', $user->id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                ->orderBy('pedidos.data')
                ->get();

            $item_max_last = DB::table('pedidos')
                ->limit(1)
                ->selectRaw('pedidos.data')
                ->where('pedidos.user_id', $user->id)
                ->where('pedidos.loja_id', $canais[$i]->bling_id)
                ->orderBy('pedidos.data', 'DESC')
                ->get();

            foreach ($pedidos as $pedido) {
                $canais[$i]->quantidade += 1;
                $canais[$i]->faturamento += ($pedido->total ?? '0');
            }
            $canais[$i]->primeira_venda = ($item_max_first['0']->data ?? '00/00/0000');
            $canais[$i]->ultima_venda = ($item_max_last['0']->data ?? '00/00/0000');
            $canais[$i]->dias_ultima_venda = (new DateTime($canais[$i]->ultima_venda))->diff($dataAtual)->days;
            $canais[$i]->contribuicao = ($canais[$i]->faturamento / $total_fat) * 100;

            $dataMenos24M = new DateTime($dataAtual->format('Y-m-d'));
            $dataMenos24M->sub(new DateInterval('P24M'));
        }

        $canaisVendas = $canais;

        foreach ($canaisVendas as $canalVenda) {
            if ($canalVenda->quantidade > 0) {
                $canaisMaisVendidos[] = $canalVenda;
            }
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $formatterCurrency = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return view('canais.index', [
            'formatterCurrency' => $formatterCurrency,

            'lojas' => $lojas,
            'lojas_data' => $lojas_data,

            'lojas_label' => $lojas_label,

            'canaisMaisVendidos' => $canaisMaisVendidos,
        ]);
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $user_id = $request->user()->id;
        $loja_id = $request['canai'];

        $loja = Loja::where('user_id', $user_id)->where('bling_id', $loja_id)->firstOrFail();

        return view('canais.show', [
            'loja' => $loja,
        ]);
    }
}
