@foreach ($situacoes as $situacao)
    <div class="col-xl-3 col-md-6">
        <div class="card  text-white mb-4" style="background-color: {{$situacao->cor}}">
            <div class="card-body">{{$situacao->nome}}</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <label class="small text-white stretched-link">{{$situacao->val}}</label>
                <div class="small text-white">Qtd: {{$situacao->qtd}}</i></div>
            </div>
        </div>
    </div>
@endforeach

{{-- <div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">Pedidos Hoje</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label class="small text-white stretched-link">{{$val_pedidos_hoje}}</label>
            <div class="small text-white">Qtd: {{$qtd_pedidos_hoje}}</i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body">Pedidos Mês</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label class="small text-white stretched-link">{{$val_pedidos_mes}}</label>
            <div class="small text-white">Qtd: {{$qtd_pedidos_mes}}</i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Pedidos Ano</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label class="small text-white stretched-link">{{$val_pedidos_ano}}</label>
            <div class="small text-white">Qtd: {{$qtd_pedidos_ano}}</div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Pedidos Total</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label class="small text-white stretched-link">{{$val_pedidos_total}}</label>
            <div class="small text-white">Qtd: {{$qtd_pedidos_total}} </div>
        </div>
    </div>
</div> --}}