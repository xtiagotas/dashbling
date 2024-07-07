<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Deposito;
use App\Models\Estoque;
use App\Models\Pedido;
use App\Services\BlingDataService;
use Exception;

class BlingDepositoService
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
            $url = '/depositos?pagina=' . $page . '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Deposito::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $deposito = new Deposito();
                        $deposito->user_id = $this->bling_token->user_id;
                        $deposito->bling_id = $data['id'];
                        $deposito->descricao = $data['descricao'];
                        $deposito->situacao = $data['situacao'];
                        $deposito->padrao = $data['padrao'];
                        $deposito->desconsiderarSaldo = $data['desconsiderarSaldo'];
                        // $deposito->saldoFisico = $data['saldoFisico'];
                        // $deposito->saldoVirtual = $data['saldoVirtual'];
                        $deposito->sync = '';
                        $deposito->save();
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
