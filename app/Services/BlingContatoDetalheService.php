<?php

namespace App\Services;

use App\Jobs\SyncContatoDetalhe;
use App\Models\BlingToken;
use App\Models\Contato;
use App\Services\BlingDataService;

class BlingContatoDetalheService
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
        $contatos = Contato::where('sync', '')->where('user_id', $this->bling_token->user_id)->take(100)->get();

        foreach($contatos as $contato) {
            $url = '/contatos/' . $contato->bling_id;

            $result = $this->blingDataService->execute($url);  
    
            if ( array_key_exists('data', $result) && (count($result['data']) > 0) ) {
                
                $data =  $result['data'];

                $contato->fantasia = $data['fantasia'];
                $contato->tipo = $data['tipo'];
                $contato->endereco_uf = $data['endereco']['geral']['uf'];
                $contato->endereco_municipio = $data['endereco']['geral']['municipio']; 
                $contato->sync = '1';  
                $contato->save();   
            }    
        }
       
        return ;
    }
}
