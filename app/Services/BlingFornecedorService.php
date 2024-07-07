<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Deposito;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Produto;
use App\Services\BlingDataService;

class BlingFornecedorService
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

        // $produtos_id = '';
        // $produtos = Produto::where('user_id', $this->bling_token->user_id)->get();
        // foreach ($produtos as $produto) {
        //     if ($produtos_id != '') {
        //         $produtos_id .= '&';
        //     }
        //     $produtos_id .= 'idsProdutos[]=' . $produto->bling_id;
        // }

        do {
            $url = '/produtos/fornecedores?pagina=' . $page . '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    $produto = Produto::where('user_id', $this->bling_token->user_id)
                        ->where('bling_id', $data['produto']['id'])->firstOrFail();

                    if ($data['padrao'] == true) {
                        $produto->precoCusto = $data['precoCusto'];
                        $produto->precoCompra = $data['precoCompra'];

                    } else if ($data['padrao'] == false) {
                        $produto->precoCusto = $produto->precoCusto ?? $data['precoCusto'];
                        $produto->precoCompra = $produto->precoCompra ?? $data['precoCompra'];
                    }

                    $produto->save();
                }

                $page++;
            } else {

                $continue = false;
            }
        } while ($continue);

        return;
    }
}
