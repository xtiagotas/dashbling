{{-- START 12 MESES --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Faturamento Ultimos 12 Meses
        </div>
        <div class="card-body">
            <canvas id="fatMesChart" width="100%" height="50"></canvas>
            <script>
                window.addEventListener("load", function(event) {
                    var ctx = document.getElementById("fatMesChart");
                    var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                @foreach ($meses as $mes)
                                    '{{ $mes->nome }}',
                                @endforeach
                            ],
                            datasets: [{
                                label: "R$ Venda",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: [
                                    @foreach ($meses as $mes)
                                        '{{ $mes->val }}',
                                    @endforeach
                                ],
                            }],
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'month'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 12
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
                                display: true,
                                text: "Histórico vendas mensal"
                            }
                        }
                    });
                }, false);
            </script>
        </div>
    </div>
</div>
{{-- END 12 MESES --}}
