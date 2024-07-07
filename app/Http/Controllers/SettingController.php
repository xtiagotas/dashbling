<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Subscription;

class SettingController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        $user = $request->user();
        $assinaturas = Subscription::where('user_id', $user->id)->where('stripe_status', '<>', 'canceled')->get();

        return view('settings.edit', [
            'bling_token' => $request->user()->bling_token,
            'bling_lojas' => $request->user()->lojas,
            'assinaturas' =>  $assinaturas
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->all();

        $lojas = $request->user()->lojas;

        foreach ($lojas as $loja) {
            $loja->nome = $data['loja_nome_'.$loja->bling_id];
            $loja->save();
        }

        return Redirect::route('settings.edit');
    }
}
