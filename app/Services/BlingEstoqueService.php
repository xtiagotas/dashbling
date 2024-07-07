<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Deposito;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Produto;
use App\Services\BlingDataService;

class BlingEstoqueService
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

        $produtos_id = '';
        $produtos = Produto::where('user_id', $this->bling_token->user_id)->get();
        foreach ($produtos as $produto) {
            if ($produtos_id != '') {
                $produtos_id .= '&';
            }
            $produtos_id .= 'idsProdutos[]=' . $produto->bling_id;
        }

        $url = '/estoques/saldos?' . $produtos_id;
        $result = $this->blingDataService->execute($url);

        if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

            foreach ($result['data'] as $data) {

                $produto = Produto::where('user_id', $this->bling_token->user_id)
                    ->where('bling_id', $data['produto']['id'])->firstOrFail();

                $produto->estoque = $data['saldoFisicoTotal'];
                $produto->save();

                foreach ($data['depositos'] as $data2) {
                    $estoque = Estoque::where('user_id', $this->bling_token->user_id)
                        ->where('produto_id', $produto->bling_id)
                        ->where('deposito_id', $data2['id'])
                        ->first();

                    if ($estoque) {
                        $estoque->saldoFisico = $data2['saldoFisico'];
                        $estoque->saldoVirtual = $data2['saldoVirtual'];
                        $estoque->save();

                    } else {

                        $estoque = new Estoque();
                        $estoque->user_id = $this->bling_token->user_id;
                        $estoque->produto_id = $produto->bling_id;
                        $estoque->deposito_id = $data2['id'];
                        $estoque->saldoFisico = $data2['saldoFisico'];
                        $estoque->saldoVirtual = $data2['saldoVirtual'];
                        $estoque->sync = '';
                        $estoque->save();
                    }
                }
            }
        }

        return;
    }
}
