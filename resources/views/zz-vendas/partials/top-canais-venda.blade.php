{{-- START TOP 5 CANAIS DE VENDA --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-desktop me-1"></i>
            Top 5 Canais de venda
        </div>
        <div class="card-body">
            <div class="card-body-chart">
                <canvas id="topCanaisChart"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- END TOP 5 CANAIS DE VENDA --}}

<script>
    window.addEventListener("load", function(event) {
        var myPieChart = new Chart("topCanaisChart", {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($lojasx as $loja)
                        '{{ $loja->tipo }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($lojasx as $loja)
                            '{{ $loja->val }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)', // Azul Marinho
                        'rgb(255, 159, 64)', // Laranja
                        'rgb(255, 205, 86)', // Amarelo
                        'rgb(75, 192, 192)', // Verde
                        'rgb(153, 102, 255)' // Roxo
                    ],
                    borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                legend: {
                    display: false // Oculta a legenda
                },
                title: {
                    display: false,
                    text: 'Top 5 Canais de venda'
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    }, false);
</script>
