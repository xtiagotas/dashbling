<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $periodo = $request['periodo'];

        $data_de = new DateTime(implode('-', array_reverse(explode('/', substr($periodo, 0, 10)))));
        $data_ate = new DateTime(implode('-', array_reverse(explode('/', substr($periodo, 13, 10)))));

        // Session::put('data_de', $data_de->format('Y-m-d'));
        // Session::put('data_ate', $data_ate->format('Y-m-d'));
        setDataDe($data_de);
        setDataAte($data_ate);

        return redirect()->back();
    }
}
