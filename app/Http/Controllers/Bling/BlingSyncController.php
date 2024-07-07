<?php

namespace App\Http\Controllers\Bling;

use App\Http\Controllers\Controller;
use App\Jobs\Bling\BlingSyncData;
use Illuminate\Http\Request;

class BlingSyncController extends Controller
{
    public function index(Request $request)
    {
        $bling_token = $request->user()->bling_token;
        BlingSyncData::dispatch($bling_token);

        $msg ='Pedido de sincronização realizado. Essa operação pode levar vários minutos!';
        return view('sync', ['msg' => $msg]);
    }
}
