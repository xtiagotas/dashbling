<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Faturamento</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $formatter->formatCurrency($faturamento_bruto, 'BRL') }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        pedidos</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pedidos_emitidos }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Produtos</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $itens_vendidos }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-box fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Ticket Médio</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $formatter->formatCurrency($ticket_medio, 'BRL') }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
