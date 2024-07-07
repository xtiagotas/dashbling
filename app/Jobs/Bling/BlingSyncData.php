<?php

namespace App\Jobs\Bling;

use App\Models\BlingToken;
use App\Services\BlingDepositoService;
use App\Services\BlingEstoqueService;
use App\Services\BlingFornecedorService;
use App\Services\BlingCategoriaService;
use App\Services\BlingContatoDetalheService;
use App\Services\BlingContatoService;
use App\Services\BlingLojaService;
use App\Services\BlingNotaService;
use App\Services\BlingPedidoService;
use App\Services\BlingPedidoDetalheService;
use App\Services\BlingProdutoDetalheService;
use App\Services\BlingProdutoService;
use App\Services\BlingRefreshTokenService;
use App\Services\BlingSituacaoService;
use App\Services\BlingVendedorService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlingSyncData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bling_token;

    private $blingRefreshTokenService;

    private $blingLojaService;
    private $blingCategoriaService;
    private $blingSituacaoService;
    private $blingProdutoService;
    private $blingNotaService;
    private $blingPedidoService;
    private $blingContatoService;
    private $blingVendedorService;
    private $blingDepositoService;
    private $blingEstoqueService;
    private $blingFornecedorService;

    private $blingPedidoDetalheService;
    private $blingContatoDetalheService;
    private $blingProdutoDetalheService;

    /**
     * Create a new job instance.
     */
    public function __construct(BlingToken $bling_token)
    {
        $this->bling_token = $bling_token;

        $this->blingRefreshTokenService = new BlingRefreshTokenService($bling_token);

        $this->blingLojaService = new BlingLojaService($bling_token);
        $this->blingCategoriaService = new BlingCategoriaService($bling_token);
        $this->blingSituacaoService = new BlingSituacaoService($bling_token);
        $this->blingProdutoService = new BlingProdutoService($bling_token);
        $this->blingNotaService = new BlingNotaService($bling_token);
        $this->blingPedidoService = new BlingPedidoService($bling_token);
        $this->blingContatoService = new BlingContatoService($bling_token);
        $this->blingVendedorService = new BlingVendedorService($bling_token);
        $this->blingDepositoService = new BlingDepositoService($bling_token);
        $this->blingEstoqueService = new BlingEstoqueService($bling_token);
        $this->blingFornecedorService = new BlingFornecedorService($bling_token);

        $this->blingPedidoDetalheService = new BlingPedidoDetalheService($bling_token);
        $this->blingContatoDetalheService = new BlingContatoDetalheService($bling_token);
        $this->blingProdutoDetalheService = new BlingProdutoDetalheService($bling_token);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = date("Y-m-d H:i:s");

        $this->bling_token->sync = '2';
        $this->bling_token->save();

        try {
            $this->blingRefreshTokenService->execute();
            //usleep(333.333);

            $this->blingNotaService->execute();
            //usleep(333.333);
            $this->blingPedidoService->execute();
            //usleep(333.333);
            $this->blingContatoService->execute();
            //usleep(333.333);
            $this->blingLojaService->execute();
            //usleep(333.333);
            $this->blingProdutoService->execute();
            //usleep(333.333);
            $this->blingCategoriaService->execute();
            //usleep(333.333);
            $this->blingSituacaoService->execute();
            //usleep(333.333);
            $this->blingVendedorService->execute();
            //usleep(333.333);
            $this->blingDepositoService->execute();
            //usleep(333.333);
            $this->blingEstoqueService->execute();
            //usleep(333.333);
            $this->blingFornecedorService->execute();
            //usleep(333.333);

            $this->blingContatoDetalheService->execute();
            //usleep(333.333);
            $this->blingProdutoDetalheService->execute();
            //usleep(333.333);
            $this->blingPedidoDetalheService->execute();
            //usleep(333.333);

        } catch (Exception $e) {
            // fazer alguam coisa aqui
        }

        $this->bling_token->sync = '1';
        $this->bling_token->save();
    }
}
