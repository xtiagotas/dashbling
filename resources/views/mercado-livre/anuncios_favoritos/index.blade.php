<x-app-layout>
    <h1 class="mt-4">Monitoramento de Anúncios</h1>
    <form action="{{ route('anuncios_favoritos.store') }}" method="POST">
        @csrf
        <label for="url_anuncio">URL do Anúncio:</label>
        <input type="url" name="url_anuncio" id="url_anuncio" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Anúncios Favoritos</h2>
    @foreach ($anuncios as $anuncio)
        <h3>Anúncio: <a href="{{ $anuncio->url_anuncio }}" target="_blank">{{ $anuncio->id_anuncio }}</a></h3>
        <canvas id="chart-{{ $anuncio->id }}" width="400" height="200"></canvas>
        <script>
            window.addEventListener("load", function(event) {
                var ctx{{ $anuncio->id }} = document.getElementById('chart-{{ $anuncio->id }}');
                var chart{{ $anuncio->id }} = new Chart(ctx{{ $anuncio->id }}, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($anuncio->historicos->pluck('data')->toArray()) !!},
                        datasets: [{
                            label: 'Quantidade Vendida',
                            data: {!! json_encode($anuncio->historicos->pluck('quantidade_vendida')->toArray()) !!},
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: false
                        }, {
                            label: 'Visitas',
                            data: {!! json_encode($anuncio->historicos->pluck('visitas')->toArray()) !!},
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            fill: false
                        }]
                    }
                });
            }, false);
        </script>
    @endforeach
</x-app-layout>
