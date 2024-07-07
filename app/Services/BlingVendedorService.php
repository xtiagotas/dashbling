<?php

namespace App\Services;

use App\Models\BlingToken;

use App\Models\Vendedor;
use App\Services\BlingDataService;

class BlingVendedorService
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
            $url = '/vendedores?pagina=' . $page. '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Vendedor::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $vendedor = new Vendedor();
                        $vendedor->user_id = $this->bling_token->user_id;
                        $vendedor->bling_id = $data['id'];
                        $vendedor->descontoLimite = $data['descontoLimite'];
                        $vendedor->loja_id = $data['loja']['id'];
                        $vendedor->contato_id = $data['contato']['id'];
                        $vendedor->contato_nome = $data['contato']['nome'];
                        $vendedor->contato_situacao = $data['contato']['situacao'];
                        $vendedor->sync = '';  
                        $vendedor->save();   
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
