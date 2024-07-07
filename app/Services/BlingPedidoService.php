<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Pedido;
use App\Services\BlingDataService;

class BlingPedidoService
{
    private $bling_token;
    private $blingDataService;

    public function __construct(BlingToken $bling_token)
    {
        $this->bling_token = $bling_token;
        $this->blingDataService = new BlingDataService($bling_token);
    }

    public function execute()
    {
        $page = 1;
        $continue = true;

        do {
            $url = env('BLING_BASE_URL')  . '/pedidos/vendas?pagina=' . $page . '&limite=100';
            $response = $this->blingDataService->execute($url);

            if (array_key_exists('data', $response) && (count($response['data']) > 0)) {

                foreach ($response['data'] as $data) {
                    $pedido = Pedido::where('bling_id', $data['id'])->first();

                    if ($pedido) {
                        // Atualizar status do pedido se tiver mudado
                        if ($pedido->status != $data['status']) {
                            $pedido->status = $data['status'];
                            $pedido->save();
                        }
                    } else {
                        // Criar novo pedido se não existir
                        Pedido::create([
                            'user_id' => $this->bling_token->user_id,
                            'bling_id' => $data['id'],
                            'numero' => $data['numero'],
                            'numeroLoja' => $data['numeroLoja'],
                            'data' => $data['data'],
                            'dataSaida' => $data['dataSaida'],
                            'dataPrevista' => $data['dataPrevista'],
                            'totalProdutos' => $data['totalProdutos'],
                            'total' => $data['total'],
                            'contato_id' => $data['contato']['id'],
                            'contato_nome' => $data['contato']['nome'],
                            'contato_tipoPessoa' => $data['contato']['tipoPessoa'],
                            'situacao_id' => $data['situacao']['id'],
                            'situacao_valor' => $data['situacao']['valor'],
                            'loja_id' => $data['loja']['id'],
                            'sync' => '',
                        ]);
                    }
                }

                $page++;
            } else {

                $continue = false;
            }
        } while ($continue);

        return;
    }
}
