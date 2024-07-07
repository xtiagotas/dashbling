{{-- START CLIENTES NOVOS E RECORRENTES --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Clientes Venda Ùnica vs. Recorrente
        </div>
        <div class="card-body">
            <div class="card-body-chart">
                <canvas id="clienteVendaUnicaRecorrente"></canvas>
            </div>
            {{-- <canvas id="clienteVendaUnicaRecorrente" width="100%" height="50"></canvas> --}}

        </div>
    </div>
</div>
{{-- END CLINETES NOVOS E RECORRENTES --}}

<script>
    window.addEventListener("load", function(event) {
        var myPieChart = new Chart("clienteVendaUnicaRecorrente", {
            type: 'doughnut',
            data: {
                labels: ['Compra Única', 'Compra Recorrente'],
                datasets: [{
                    label: 'Qtd Pedidos',
                    data: [{{ $clientes['vendaUnica'] }}, {{ $clientes['recorrente'] }}],
                    backgroundColor: [
                        'rgb(255, 99, 132)', // Vermelho Coral
                        'rgb(54, 162, 135)' // Ciano Escuro
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 135)'
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
