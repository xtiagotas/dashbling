<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Receita por canal de venda (24 Meses)
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-12">
                    <canvas id="canaisLineChart" width="150%" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        const labels = [
            @foreach ($lojas_label as $loja_labe)
                '{{ $loja_labe->dt }}',
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [
                @foreach ($lojas as $loja)
                    {
                        label: '{{ $loja->tipo }}',
                        data: [
                            @foreach ($lojas_data as $loja_data)
                                @if ($loja_data->loja == $loja->tipo)
                                    {{ $loja_data->val ?? '0' }},
                                @endif
                            @endforeach
                        ],
                        borderColor: randColor(),
                        fill: false,
                        backgroundColor: 'white',
                    },
                @endforeach
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: "Faturamento por canal de venda"
                }
            },
        };
        new Chart("canaisLineChart", config);

    }, false);
</script>
