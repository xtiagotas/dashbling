<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Nota;
use App\Services\BlingDataService;

class BlingNotaService
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
            $url = '/nfe?pagina=' . $page . '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Nota::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $nota = new Nota();
                        $nota->user_id = $this->bling_token->user_id;
                        $nota->bling_id = $data['id'];
                        $nota->tipo = $data['tipo'] ?? '';
                        $nota->situacao = $data['situacao'] ?? '';
                        $nota->numero = $data['numero'] ?? '';
                        $nota->serie = $data['serie'] ?? '';
                        $nota->dataEmissao = $data['dataEmissao'];
                        $nota->dataOperacao = $data['dataOperacao'];
                        $nota->contato_id = $data['contato']['id'];
                        $nota->endereco_uf = $data['contato']['endereco']['uf'];
                        $nota->endereco_municipio = $data['contato']['endereco']['municipio'];
                        $nota->loja = $data['loja']['id'];
                        $nota->sync = '';
                        $nota->save();
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
