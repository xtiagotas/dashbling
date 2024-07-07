<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Produto;

use App\Services\BlingDataService;

class BlingProdutoDetalheService
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
        $produtos = Produto::where('sync', '')->where('user_id', $this->bling_token->user_id)->take(100)->get();

        foreach ($produtos as $key => $produto) {
            $url = '/produtos/' . $produto->bling_id;

            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                $data =  $result['data'];    
                $produto->idProdutoPai = $data['idProdutoPai'] ?? '';  
                $produto->dataValidade = $data['dataValidade'];  
                $produto->unidade = $data['unidade'];  
                $produto->pesoLiquido = $data['pesoLiquido'];  
                $produto->pesoBruto = $data['pesoBruto'];  
                $produto->volumes = $data['volumes'];  
                $produto->itensPorCaixa = $data['itensPorCaixa'];  
                $produto->gtin = $data['gtin'];  
                $produto->gtinEmbalagem = $data['gtinEmbalagem'];  
                $produto->tipoProducao = $data['tipoProducao'];  
                $produto->condicao = $data['condicao'];  
                $produto->freteGratis = $data['freteGratis'];  
                $produto->marca = $data['marca'];  
                $produto->categoria_id = $data['categoria']['id'];  
                $produto->estoque_minimo = $data['estoque']['minimo'];  
                $produto->estoque_maximo = $data['estoque']['maximo'];  
                $produto->estoque_crossdocking = $data['estoque']['crossdocking'];  
                $produto->estoque_localizacao = $data['estoque']['localizacao'];  
                $produto->dimensoes_largura = $data['dimensoes']['largura'];  
                $produto->dimensoes_altura = $data['dimensoes']['altura'];  
                $produto->dimensoes_profundidade = $data['dimensoes']['profundidade'];  
                $produto->dimensoes_unidadeMedida = $data['dimensoes']['unidadeMedida'];  
                $produto->sync = '1';
                $produto->save();   
            } 
        }

        return;
    }
}
