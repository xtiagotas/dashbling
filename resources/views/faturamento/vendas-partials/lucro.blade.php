<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            {{-- <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Lucro x
        </div> --}}
            {{-- <div class="card-body"> --}}
            <div class="row">
                {{-- <div class="col-sm-3 col-md-3 col-lg-12">
                    @include('vendas.partials.canais')
                </div> --}}
                {{-- <div class="col-sm-9 col-md-9 col-lg-3">
                    @include('dashboard.partials.situacao')
                </div> --}}
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ '100%' }}</span> <br />
                    <span><b>{{ $formatter->formatCurrency($faturamento_bruto, 'BRL') }}</b></span> <br />
                    <span>Faturamento Bruto</span>

                </div>
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ number_format($percent_impostos, 2) }} %</span> <br />
                    <span><b>{{ $formatter->formatCurrency($total_impostos, 'BRL') }}</b></span> <br />
                    <span>Despesas Impostos</span>
                </div>
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ number_format($percent_frete, 2) }} %</span> <br />
                    <span><b>{{ $formatter->formatCurrency($total_frete, 'BRL') }}</b></span> <br />
                    <span>Despesas Com Frete</span>
                </div>
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ number_format($percent_desconto, 2) }} %</span> <br />
                    <span><b>{{ $formatter->formatCurrency($total_descontos, 'BRL') }}</b></span> <br />
                    <span>Descontos Aplicados</span>
                </div>
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ number_format($percent_prod, 2) }} %</span> <br />
                    <span><b>{{ $formatter->formatCurrency($total_prod, 'BRL') }}</b></span> <br />
                    <span>Custos De Produtos</span>
                </div>
                <div class="card-body col-lg-1" style="text-align: center">
                    <span>{{ number_format($percent_lucro, 2) }} %</span> <br />
                    <span><b>{{ $formatter->formatCurrency($total_lucro, 'BRL') }}</b></span> <br />
                    <span>Margem de Lucro</span>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
