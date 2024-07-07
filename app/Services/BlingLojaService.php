<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Loja;

use App\Services\BlingDataService;

class BlingLojaService
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
            $url = '/canais-venda?pagina=' . $page. '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Loja::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $loja = new Loja();
                        $loja->user_id = $this->bling_token->user_id;
                        $loja->bling_id = $data['id'];
                        $loja->descricao = $data['descricao'];
                        $loja->tipo = $data['tipo'];
                        $loja->situacao = $data['situacao'];
                        $loja->sync = '1';  
                        $loja->save();   
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
