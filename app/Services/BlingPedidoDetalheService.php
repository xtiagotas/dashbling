<?php

namespace App\Services;

use App\Jobs\SyncItemPedido;
use App\Models\BlingToken;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Services\BlingDataService;

class BlingPedidoDetalheService
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
        $pedidos = Pedido::where('sync', '')->where('user_id', $this->bling_token->user_id)->take(100)->get();

        foreach($pedidos as $pedido) {
            $url = '/pedidos/vendas/' . $pedido->bling_id;

            $result = $this->blingDataService->execute($url);
    
            if ( array_key_exists('data', $result) && (count($result['data']) > 0) ) {
                // $this->saveData($pedido, $data['data']['itens']);

                $pedido->outrasDespesas = $result['data']['outrasDespesas'];
                $pedido->desconto = $result['data']['desconto']['valor'];

                $pedido->notaFiscal_id = $result['data']['notaFiscal']['id'] ?? '';
                
                $pedido->tributacao_totalICMS = $result['data']['tributacao']['totalICMS'];
                $pedido->tributacao_totalIPI = $result['data']['tributacao']['totalIPI'];
                
                $pedido->transporte_fretePorConta = $result['data']['transporte']['fretePorConta'];
                $pedido->transporte_frete = $result['data']['transporte']['frete'];
                
                $pedido->transporte_contato_id = $result['data']['transporte']['contato']['id'];
                $pedido->transporte_contato_nome = $result['data']['transporte']['contato']['nome'];
                
                $pedido->transporte_etiqueta_nome = $result['data']['transporte']['etiqueta']['nome'];
                $pedido->transporte_etiqueta_municipio = $result['data']['transporte']['etiqueta']['municipio'];
                $pedido->transporte_etiqueta_uf = $result['data']['transporte']['etiqueta']['uf'];
                $pedido->transporte_etiqueta_cep = $result['data']['transporte']['etiqueta']['cep'];
                
                $pedido->taxas_taxaComissao = $result['data']['taxas']['taxaComissao'];
                $pedido->taxas_custoFrete = $result['data']['taxas']['custoFrete'];
                $pedido->taxas_valorBase = $result['data']['taxas']['valorBase'];
                
                $pedido->vendedor_id = $result['data']['vendedor']['id'] ?? '';

                foreach ($result['data']['itens'] as $item) {
                    $itemPedido = new ItemPedido();
                    $itemPedido->user_id = $pedido->user_id;
                    $itemPedido->pedido = $pedido->bling_id;
                    $itemPedido->bling_id = $item['id'];
                    $itemPedido->codigo = $item['codigo'];
                    $itemPedido->unidade = $item['unidade'];
                    $itemPedido->quantidade = $item['quantidade'];
                    $itemPedido->desconto = $item['desconto'];
                    $itemPedido->valor = $item['valor'];
                    $itemPedido->aliquotaIPI = $item['aliquotaIPI'];
                    $itemPedido->descricao = $item['descricao'];
                    $itemPedido->descricaoDetalhada = $item['descricaoDetalhada'];
                    $itemPedido->produto = $item['produto']['id'] ?? '';   
                    $itemPedido->sync = '1';  
                    $itemPedido->save();      
                }
    
                $pedido->sync = '1';
                $pedido->save();
            }   
        }

        // $qtdNotSync = Pedido::where('sync', '')->where('user_id', $this->bling_token->user_id)->count();
        // if ($qtdNotSync > 0) {
        //     SyncItemPedido::dispatch($this->bling_token);
        // }
       
        return ;
    }
    
    // private function getData($pedido)
    // {
    //     $url = '/pedidos/vendas/' . $pedido->bling_id;

    //     $data = $this->blingDataService->execute($url);

    //     if ( array_key_exists('data', $data) && (count($data['data']) > 0) ) {
    //         $this->saveData($pedido, $data['data']['itens']);
    //     }   

    //     return;
    // }

    // private function saveData($pedido, $data)
    // {
    //     foreach ($data as $item) {
    //         $itemPedido = new ItemPedido();
    //         $itemPedido->user_id = $pedido->user_id;
    //         $itemPedido->pedido = $pedido->bling_id;
    //         $itemPedido->bling_id = $item['id'];
    //         $itemPedido->codigo = $item['codigo'];
    //         $itemPedido->unidade = $item['unidade'];
    //         $itemPedido->quantidade = $item['quantidade'];
    //         $itemPedido->desconto = $item['desconto'];
    //         $itemPedido->valor = $item['valor'];
    //         $itemPedido->aliquotaIPI = $item['aliquotaIPI'];
    //         $itemPedido->descricao = $item['descricao'];
    //         $itemPedido->descricaoDetalhada = $item['descricaoDetalhada'];
    //         $itemPedido->produto = $item['produto']['id'] ?? '';   
    //         $itemPedido->sync = '1';  
    //         $itemPedido->save();      
    //     }

    //     $pedido->sync = '1';
    //     $pedido->save();
        
    //     return ;
    // }
}
