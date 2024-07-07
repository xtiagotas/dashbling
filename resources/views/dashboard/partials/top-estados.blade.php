{{-- START TOP 5 CANAIS DE VENDA --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-desktop me-1"></i>
            Top 5 Estados
        </div>
        <div class="card-body">
            <canvas id="topRegioesChart" width="100%" height="50"></canvas>
        </div>
    </div>
</div>
{{-- END TOP 5 CANAIS DE VENDA --}}

<script>
    window.addEventListener("load", function(event) {
        const ctxx = document.getElementById('topRegioesChart').getContext('2d');

        var topRegioesChart = new Chart(ctxx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($regioes as $regiao)
                        '{{ $regiao->uf }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Vendas',
                    data: [
                        @foreach ($regioes as $regiao)
                            '{{ $regiao->val }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(0, 70, 140)', // Azul Marinho
                        'rgb(85, 107, 47)', // Verde Oliva
                        'rgb(255, 87, 34)', // Laranja Avermelhado
                        'rgb(255, 215, 0)', // Amarelo Ouro
                        'rgb(138, 43, 226)' // Roxo Ametista
                    ],
                    borderColor: [
                        'rgb(0, 70, 140)',
                        'rgb(85, 107, 47)',
                        'rgb(255, 87, 34)',
                        'rgb(255, 215, 0)',
                        'rgb(138, 43, 226)'
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
                    text: 'Top 5 Estados Mais Vendidos'
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