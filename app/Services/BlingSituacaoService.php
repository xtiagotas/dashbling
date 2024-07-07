<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Situacao;

use App\Services\BlingDataService;

class BlingSituacaoService
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
        // $page = 1;
        $continue = true;

        // do {
            $url = '/situacoes/modulos';
            $result_1 = $this->blingDataService->execute($url);

            if ( array_key_exists('data', $result_1) && (count($result_1['data']) > 0) ) {

                foreach ($result_1['data'] as $data_1) {

                    $url_2 = '/situacoes/modulos/' . $data_1['id'];
                    $result_2 = $this->blingDataService->execute($url_2);
    
                    foreach ($result_2['data'] as $data_2) {    

                        if (Situacao::where('bling_id', $data_2['id'])->count() > 0) {

                            $continue = false;
                        } else {

                            $situacao = new Situacao();
                            $situacao->user_id = $this->bling_token->user_id;
                            $situacao->bling_id = $data_2['id'];
                            $situacao->modulo_id = $data_1['id'];
                            $situacao->modulo_descricao = $data_1['descricao'];
                            $situacao->nome = $data_2['nome'];
                            $situacao->idHerdado = $data_2['idHerdado'];
                            $situacao->cor = $data_2['cor'];
                            $situacao->sync = '1';  
                            $situacao->save();      
                        }
                    }
                }  

                // $page++;
            } //else {
                
            //     $continue = false;
            // }
        // } while ($continue);

        return;
    }
}
