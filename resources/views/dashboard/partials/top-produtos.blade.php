{{-- START TOP 5 CANAIS DE VENDA --}}
<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-desktop me-1"></i>
            Top 5 Produtos
        </div>
        <div class="card-body">
            <canvas id="topProdutosChart" width="100%" height="50"></canvas>
            <script>
                window.addEventListener("load", function(event) {
                    var myPieChart = new Chart("topProdutosChart", {
                        type: 'bar',
                        data: {
                            labels: [
                                @foreach ($produtos as $produto)
                                    '{{ $produto->sku }}',
                                @endforeach
                            ],
                            datasets: [{
                                data: [
                                    @foreach ($produtos as $produto)
                                        '{{ $produto->val }}',
                                    @endforeach
                                ],
                                backgroundColor: [
                                    'rgb(33, 102, 172)', // Azul Escuro
                                    'rgb(102, 194, 165)', // Verde Claro
                                    'rgb(255, 220, 77)', // Amarelo Ouro
                                    'rgb(252, 141, 89)', // Laranja Forte
                                    'rgb(117, 107, 177)' // Roxo Escuro
                                ],
                                borderColor: [
                                    'rgb(33, 102, 172)',
                                    'rgb(102, 194, 165)',
                                    'rgb(255, 220, 77)',
                                    'rgb(252, 141, 89)',
                                    'rgb(117, 107, 177)'
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
                                text: 'Top 5 Produtos Mais Vendidos'
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
        </div>
    </div>
</div>
{{-- END TOP 5 CANAIS DE VENDA --}}
