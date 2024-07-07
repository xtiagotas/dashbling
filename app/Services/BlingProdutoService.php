<?php

namespace App\Services;

use App\Models\BlingToken;
use App\Models\Produto;

use App\Services\BlingDataService;

class BlingProdutoService
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
            $url = '/produtos?pagina=' . $page. '&limite=100';
            $result = $this->blingDataService->execute($url);

            if (array_key_exists('data', $result) && (count($result['data']) > 0)) {

                foreach ($result['data'] as $data) {

                    if (Produto::where('bling_id', $data['id'])->count() > 0) {

                        $continue = false;
                    } else {

                        $produto = new Produto();
                        $produto->user_id = $this->bling_token->user_id;
                        $produto->bling_id = $data['id'];
                        $produto->idProdutoPai = '';
                        $produto->nome = $data['nome'];
                        $produto->codigo = $data['codigo'];
                        $produto->preco = $data['preco'];
                        $produto->tipo = $data['tipo'];
                        $produto->situacao = $data['situacao'];
                        $produto->formato = $data['formato'];
                        $produto->descricaoCurta = $data['descricaoCurta'];
                        $produto->imagemURL = $data['imagemURL'];     
                        $produto->dataValidade = '';  
                        $produto->unidade = '';  
                        $produto->pesoLiquido = '';
                        $produto->pesoBruto = '';  
                        $produto->volumes = '';
                        $produto->itensPorCaixa = ''; 
                        $produto->gtin = '';  
                        $produto->gtinEmbalagem = '';
                        $produto->tipoProducao = '';  
                        $produto->condicao = ''; 
                        $produto->freteGratis = '';
                        $produto->marca = '';
                        // $produto->descricaoComplementar = '';  
                        // $produto->linkExterno = '';    
                        // $produto->observacoes = '';    
                        // $produto->descricaoEmbalagemDiscreta = '';   
                        $produto->categoria_id = '';  
                        $produto->estoque = '0';  
                        $produto->estoque_minimo = '';  
                        $produto->estoque_maximo = '';    
                        $produto->estoque_crossdocking = '';    
                        $produto->estoque_localizacao = '';   
                        // $produto->actionEstoque = '';  
                        $produto->dimensoes_largura = '';    
                        $produto->dimensoes_altura = '';    
                        $produto->dimensoes_profundidade = '';    
                        $produto->dimensoes_unidadeMedida = '';  
                        // $produto->tributacao_origem = '';  
                        // $produto->tributacao_nFCI = '';  
                        // $produto->tributacao_ncm = '';   
                        // $produto->tributacao_cest = '';  
                        // $produto->tributacao_codigoListaServicos = '';   
                        // $produto->tributacao_spedTipoItem = '';  
                        // $produto->tributacao_codigoItem = '';    
                        // $produto->tributacao_percentualTributos = '';   
                        // $produto->tributacao_valorBaseStRetencao = '';   
                        // $produto->tributacao_valorStRetencao = '';  
                        // $produto->tributacao_valorICMSSubstituto = '';  
                        // $produto->tributacao_codigoExcecaoTipi = '';    
                        // $produto->tributacao_classeEnquadramentoIpi = '';   
                        // $produto->tributacao_valorIpiFixo = '';  
                        // $produto->tributacao_codigoSeloIpi = '';   
                        // $produto->tributacao_valorPisFixo = '';  
                        // $produto->tributacao_valorCofinsFixo = '';    
                        // $produto->tributacao_codigoANP = '';  
                        // $produto->tributacao_descricaoANP = '';  
                        // $produto->tributacao_percentualGLP = '';  
                        // $produto->tributacao_percentualGasNacional = '';   
                        // $produto->tributacao_percentualGasImportado = '';    
                        // $produto->tributacao_valorPartida = '';  
                        // $produto->tributacao_tipoArmamento = '';  
                        // $produto->tributacao_descricaoCompletaArmamento = '';  
                        // $produto->tributacao_dadosAdicionais = '';  
                        // $produto->tributacao_grupoProduto_id = '';  
                        // $produto->linhaProduto_id = '';   
                        // $produto->estrutura_tipoEstoque = '';  
                        // $produto->estrutura_lancamentoEstoque = '';  
                        // $produto->estrutura_componentes_produto_id = '';  
                        // $produto->estrutura_componentes_quantidade = '';   
                        $produto->precoCusto = '0';
                        $produto->precoCompra = '0';
                        $produto->sync = '';  
                        $produto->save();   
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
