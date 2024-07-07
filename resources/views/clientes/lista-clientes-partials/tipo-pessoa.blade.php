<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-map-marker me-1"></i>
            Tipo de pessoa
        </div>
        <div class="card-body">
            <div class="card-body-chart">
                <canvas id="tipoPessoaChart"></canvas>
            </div>
            {{-- <canvas id="tipoPessoaChart" width="100%" height="50"></canvas> --}}
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        var myPieChart = new Chart("tipoPessoaChart", {
            type: 'bar',
            data: {
                labels: ['Pessoa Física', 'Pessoa Jurídica'],
                datasets: [{
                    label: 'Quantidade de Clientes',
                    data: [{{$clientesx['fisica']}}, {{$clientesx['juridica']}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Cor para Pessoa Física
                        'rgba(255, 99, 132, 0.6)' // Cor para Pessoa Jurídica
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    }
                },
                title: {
                    display: false,
                    text: 'tipo pessoa'
                }
            }

        });
    }, false);
</script>
