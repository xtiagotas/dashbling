<?php

use App\Jobs\Bling\BlingRefreshToken;
use App\Jobs\SyncContatoDetalhe;
use App\Jobs\Bling\BlingSyncData;
use App\Jobs\MercadoLivre\UpdateAnunciosFavoritos;
use App\Jobs\SyncItemPedido;
use App\Models\AnuncioFavorito;
use App\Models\BlingToken;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('app:bling-sync', function () {
//     $this->info("Atualizando dados bling!");
// });

Schedule::call(function () {
    foreach(BlingToken::where('sync', '<>', '2')->where('access_token', '<>', '')->get() as $blingToken) {
        BlingSyncData::dispatch($blingToken);
    }
})->everyTenMinutes()->name('Job New Accounts');

Schedule::call(function () {
    foreach(BlingToken::where('sync', '=', '2')->get() as $blingToken) {
        $blingToken->sync = '1';
        $blingToken->save();
    }
})->everyThirtyMinutes()->name('Job Syncing accounts');

Schedule::call(function () {
    UpdateAnunciosFavoritos::dispatch();
})->everyTenSeconds()->name('Update favorite ads data');
