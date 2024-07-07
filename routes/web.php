<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Bling\BlingAuthorizeController;
use App\Http\Controllers\Bling\BlingSyncController;
use App\Http\Controllers\Cliente\CompraFrequenteController;
use App\Http\Controllers\Cliente\CompraOcasionalController;
use App\Http\Controllers\Cliente\ListaClienteaController;
// use App\Http\Controllers\CanalVendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\Estoque\ProdutoVendidoController;
use App\Http\Controllers\Estoque\ProdutoSemVendaController;
use App\Http\Controllers\Estoque\SaldoArmazemController;
use App\Http\Controllers\Estoque\RecomendacaoCompraController;
use App\Http\Controllers\Faturamento\CanalVendaController;
use App\Http\Controllers\Faturamento\PedidoVendaController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\Logistica\EntregaController;
use App\Http\Controllers\MercadoLivre\AnuncioFavoritoController;
use App\Http\Controllers\MercadoLivre\AuthController as MercadoLivreAuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\VendaController;
use App\Http\Middleware\SubscriptionActive;

use App\Http\Controllers\Stripe\WebhookController;

Route::get('/lembrar', function () {
    return view('arrumar');
})->name('arrumar');

Route::middleware('auth')->group(function () {

    Route::middleware(SubscriptionActive::class)->group(function () {
        Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

        Route::get('/filter', [FilterController::class, 'index'])->name('filter');

        Route::get('/faturamento/pedidos-venda', [PedidoVendaController::class, 'index'])->name('faturamento.pedidos-venda');
        Route::get('/faturamento/canais-venda', [CanalVendaController::class, 'index'])->name('faturamento.canais-venda');

        Route::get('/estoque/saldos-armazem', [SaldoArmazemController::class, 'index'])->name('estoque.saldos-armazem');
        Route::get('/estoque/produtos-vendidos', [ProdutoVendidoController::class, 'index'])->name('estoque.produtos-vendidos');
        Route::get('/estoque/produtos-sem-venda', [ProdutoSemVendaController::class, 'index'])->name('estoque.produtos-sem-vendas');
        Route::get('/estoque/recomendacao-compra', [RecomendacaoCompraController::class, 'index'])->name('estoque.recomendacao-compra');
        
        Route::get('/clientes/lista-clientes', [ListaClienteaController::class, 'index'])->name('cliente.lista-clientes');

        Route::get('/logistica/entregas', [EntregaController::class, 'index'])->name('logistica.entregas');

        Route::get('/marketplace/mercado-livre/anuncios-favoritos', [AnuncioFavoritoController::class, 'index'])->name('anuncios-favoritos.index');
        Route::post('/marketplace/mercado-livre/anuncios-favoritos', [AnuncioFavoritoController::class, 'store'])->name('anuncios_favoritos.store');

        // Route::resource('/vendas', VendaController::class);
        // Route::resource('/produtos', ProdutoController::class);
        // Route::resource('/canais', CanalVendaController::class);
        // Route::resource('/clientes', ClienteController::class);
        // Route::resource('/estados', EstadoController::class);
    });

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/bling/authorize', [BlingAuthorizeController::class, 'update'])->name('authorize.update');
    Route::get('/bling/authorize', [BlingAuthorizeController::class, 'index'])->name('authorize.index');
    Route::get('/bling/sync', [BlingSyncController::class, 'index'])->name('sync.index');

    Route::get('/ajustes', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/ajustes', [SettingController::class, 'update'])->name('seetings.update');

    Route::get('/subscribe', [SubscriptionController::class, 'showSubscriptionForm'])->name('subscribe');
    Route::post('/subscribe', [SubscriptionController::class, 'processSubscription'])->name('subscription.process');
    Route::get('/subscription-success', [SubscriptionController::class, 'handleSubscriptionSuccess'])->name('subscription.success');
    Route::get('/subscription-cancel-confirm', [SubscriptionController::class, 'showCancelConfirmForm'])->name('subscription.showCancelConfirmForm');
    Route::post('/subscription-cancel', [SubscriptionController::class, 'handleSubscriptionCancel'])->name('subscription.cancel');
});

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

// Route::post('/mercado-livre/authorize', [WebhookController::class, 'handleWebhook']);

Route::get('marketplace/mercado-livre/login', [MercadoLivreAuthController::class, 'redirectToAuth'])->name('mercadolivre.login');
Route::get('marketplace/mercado-livre/callback', [MercadoLivreAuthController::class, 'handleCallback'])->name('mercadolivre.callback');

require __DIR__ . '/auth.php';
