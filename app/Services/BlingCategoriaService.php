<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Categoria;

use App\Services\BlingDataService;

class BlingCategoriaService
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
            $url = '/categorias/produtos?pagina=' . $page. '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Categoria::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $categoria = new Categoria();
                        $categoria->user_id = $this->bling_token->user_id;
                        $categoria->bling_id = $data['id'];
                        $categoria->descricao = $data['descricao'];
                        $categoria->categoriaPai = $data['categoriaPai']['id'];
                        $categoria->sync = '1';  
                        $categoria->save();    
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
