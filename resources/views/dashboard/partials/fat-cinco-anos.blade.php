{{-- START FATUAMENTO 5 ANOS --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Faturamento Últimos 5 Anos
        </div>
        <div class="card-body">
            <canvas id="fatAnoChart" width="100%" height="50"></canvas>
            <script>
                window.addEventListener("load", function(event) {
                    new Chart("fatAnoChart", {
                        type: "line",
                        data: {
                            labels: [
                                @foreach ($anos as $ano)
                                    '{{ $ano->ano }}',
                                @endforeach
                            ],
                            datasets: [{
                                label: "R$ Venda",
                                // backgroundColor: [@foreach ($anos as $ano)randColor(),@endforeach],]
                                lineTension: 0.3,
                                backgroundColor: "rgba(2,117,216,0.2)",
                                borderColor: "rgba(2,117,216,1)",
                                pointRadius: 5,
                                pointBackgroundColor: "rgba(2,117,216,1)",
                                pointBorderColor: "rgba(255,255,255,0.8)",
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                pointHitRadius: 50,
                                pointBorderWidth: 2,
                                data: [
                                    @foreach ($anos as $ano)
                                        '{{ $ano->val }}',
                                    @endforeach
                                ]
                            }]
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    time: {
                                        unit: 'year'
                                    },
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 6
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        // max: 45000,
                                        // maxTicksLimit: 5
                                    },
                                    gridLines: {
                                        // display: true
                                        color: "rgba(0, 0, 0, .125)",
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Histórico vendas anual"
                            }
                        }
                    });
                }, false);
            </script>
        </div>
    </div>
</div>
{{-- END FATUAMENTO 5 ANOS --}}
