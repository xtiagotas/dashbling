<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Faturamento por dia
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-12">
                    <canvas id="fatDiaChart" width="180%" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {

        var fatDiaChart = new Chart("fatDiaChart", {
            type: 'line',
            data: {
                labels: [
                    @foreach ($fat_dia['label'] as $key => $value)
                        '{{ $key }}',
                    @endforeach
                ],
                datasets: [{
                    label: "R$ Venda",
                    backgroundColor: "rgba(62,117,216,1)",
                    // backgroundColor: "green",
                    // borderColor: "rgba(2,117,216,1)",
                    fill: false,
                    data: [
                        @foreach ($fat_dia['data'] as $key => $value)
                            '{{ $value }}',
                        @endforeach
                    ],
                }],
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        // time: {
                        //     unit: 'month'
                        // },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 31
                        }
                    }],
                    yAxes: [{
                        // ticks: {
                        //     min: 0,
                            // max: 15000,
                            // maxTicksLimit: 5
                        // },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                // legend: {
                //     display: false
                // },
                title: {
                    display: false,
                    text: "Faturamento no período"
                }
            }
        });
    }, false);
</script>
