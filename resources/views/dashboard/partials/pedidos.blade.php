<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">Pedidos Hoje</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label
                class="small text-white stretched-link">{{ $formatter->formatCurrency($pedidos_hoje['valor'], 'BRL') }}</label>
            <div class="small text-white">Qtd: {{ $pedidos_hoje['quantidade'] }}</i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body">Pedidos Mês</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label
                class="small text-white stretched-link">{{ $formatter->formatCurrency($pedidos_mes['valor'], 'BRL') }}</label>
            <div class="small text-white">Qtd: {{ $pedidos_mes['quantidade'] }}</i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Pedidos Ano</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label
                class="small text-white stretched-link">{{ $formatter->formatCurrency($pedidos_ano['valor'], 'BRL') }}</label>
            <div class="small text-white">Qtd: {{ $pedidos_ano['quantidade'] }}</i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Pedidos Total</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <label
                class="small text-white stretched-link">{{ $formatter->formatCurrency($pedidos_todos['valor'], 'BRL') }}</label>
            <div class="small text-white">Qtd: {{ $pedidos_todos['quantidade'] }}</i></div>
        </div>
    </div>
</div>
