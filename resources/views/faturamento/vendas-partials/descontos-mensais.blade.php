<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Descontos aplicados
        </div>
        <div class="card-body">
            <canvas id="descMesChart" width="100%" height="50"></canvas>
            <script>
                window.addEventListener("load", function(event) {
                    var ctx = document.getElementById("descMesChart");
                    var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                @foreach ($descontos_meses as $desconto_mes)
                                    '{{ $desconto_mes->nome }}',
                                @endforeach
                            ],
                            datasets: [{
                                label: "R$ Venda",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: [
                                    @foreach ($descontos_meses as $desconto_mes)
                                        '{{ $desconto_mes->val }}',
                                    @endforeach
                                ],
                            }],
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: false
                            },
                            title: {
                                display: false,
                                text: "Histórico de descontos mensais"
                            },
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
                        }
                    });
                }, false);
            </script>
        </div>

        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>
</div>
