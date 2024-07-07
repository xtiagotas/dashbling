<?php

use Illuminate\Support\Facades\Session;

function setDataDe($data)
{
    Session::put('data_de', $data->format('Y-m-d'));
}

function getDataDe()
{
    $dataMenos30D = new DateTime(getDataAte()->format('Y-m-d'));
    $dataMenos30D->sub(new DateInterval('P30D'));

    return new DateTime(Session::get('data_de', $dataMenos30D->format('Y-m-d')));
}

function setDataAte($data)
{
    Session::put('data_ate', $data->format('Y-m-d'));
}

function getDataAte()
{
    return new DateTime(Session::get('data_ate', getDataATual()->format('Y-m-d')));
}

function getDataATual()
{
    $dataAtual = new DateTime();
    if (env('TEMP_DATE')) {
        $dataAtual = new DateTime(env('TEMP_DATE_VAL'));
    }

    return $dataAtual;
}
