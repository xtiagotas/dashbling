<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-map-marker me-1"></i>
            Top 5 Estados
        </div>
        <div class="card-body">
            <div class="card-body-chart">
                <canvas id="topEstadosChart"></canvas>
            </div>
            {{-- <canvas id="topEstadosChart" width="100%" height="50"></canvas> --}}
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        new Chart("topEstadosChart", {
            type: "pie",
            data: {
                labels: [
                    @foreach ($estados as $estado)
                        '{{ $estado->endereco_uf }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Vendas',
                    data: [
                        @foreach ($estados as $estado)
                            '{{ $estado->val }}',
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
                maintainAspectRatio: false, // Permite que o gráfico não mantenha uma proporção fixa
                plugins: {
                    legend: {
                        position: 'bottom' // Posição da legenda
                    }
                }
            }
        });
    }, false);
</script>
