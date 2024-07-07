<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Faturamento últimos 30 dias
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-9">
                    <canvas id="fatDiaChart" width="180%" height="50"></canvas>

                    <script>
                        window.addEventListener("load", function(event) {

                            var fatDiaChart = new Chart("fatDiaChart", {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @foreach ($fat_30dias as $pedidos)
                                            '{{ $pedidos->dataSaida }}',
                                        @endforeach
                                    ],
                                    datasets: [{
                                        label: "R$ Venda",
                                        backgroundColor: "rgba(62,117,216,1)",
                                        data: [
                                            @foreach ($fat_30dias as $pedidos)
                                                '{{ $pedidos->val }}',
                                            @endforeach
                                        ],
                                    }],
                                },
                                options: {
                                    // responsive: true,
                                    scales: {
                                        xAxes: [{
                                            time: {
                                                unit: 'day'
                                            },
                                            gridLines: {
                                                display: false
                                            },
                                            ticks: {
                                                maxTicksLimit: 31
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                                // max: 15000,
                                                // maxTicksLimit: 5
                                            },
                                            gridLines: {
                                                display: true
                                            }
                                        }],
                                    },
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: false,
                                        text: "Faturamento últimos 30 dias"
                                    }
                                }
                            });
                        }, false);
                    </script>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-3">
                    <div style="text-align: center">
                        <b for="">Status Pedidos</b>
                    </div>
                    @foreach ($situacoes['pedidos'] as $situacao)
                        <div>
                            <label style="color: {{ $situacao->cor }}">{{ $situacao->nome }}
                                ({{ $situacao->qtd }}/{{ $situacoes['totalPedidos'] }})</label>
                            <label style="color: {{ $situacao->cor }}; float: right">{{ $formatter->formatCurrency($situacao->val, 'BRL') }}</label>
                        </div>
                        <div class="progress mb-2">

                            <div class="progress-bar"
                                style="width:{{ ($situacao->qtd / $situacoes['totalPedidos']) * 100 }}%; background-color:{{ $situacao->cor }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
