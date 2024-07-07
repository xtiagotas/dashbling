<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Tipo de Cliente
        </div>
        <div class="card-body">
            <div class="card-body-chart">
                <canvas id="tipoClienteChart"></canvas>
            </div>
            {{-- <canvas id="tipoClienteChart"></canvas> --}}
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        var myPieChart = new Chart("tipoClienteChart", {
            type: 'doughnut',
            data: {
                labels: ['Compra única', 'Recorrente'],
                datasets: [{
                    label: 'Qtd Pedidos',
                    data: ['800', '200'],
                    backgroundColor: ['#FBBF24', '#1E3A8A'],
                    borderColor: ['#FBBF24', '#1E3A8A'],
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
