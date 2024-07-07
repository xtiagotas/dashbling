<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Tipo de Cliente
        </div>
        <div class="card-body">
            <canvas id="prodMaisVendido" width="100%" height="50"></canvas>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        var myPieChart = new Chart("prodMaisVendido", {
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

        });
    }, false);
</script>
