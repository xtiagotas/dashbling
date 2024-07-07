<x-app-layout>
    <h3 class="mt-3">Estados</h3>
    <hr>
    {{-- <div class="row"> --}}
        {{-- <label style="color:white">.</label> --}}
    {{-- </div> --}}

    {{-- <div class="row"> --}}
        {{-- @include('vendas.partials.filter') --}}
    {{-- </div> --}}
    {{-- <p>
        <b>QTD Ufs: </b> {{ $qtdUfs }}
    </p> --}}

    <table id="estdosDatatables">
        <tr>
            <th>id</th>
            <th>qtd</th>
            <th>val</th>
            <th></th>
        </tr>
        @foreach ($ufs as $uf)
            <tr>
                <td>{{ $uf->transporte_etiqueta_uf }}</td>
                <td>{{ $uf->qtd }}</td>
                <td>{{ $uf->val }}</td>
                <td>
                    <div style="text-align: center">
                        <a href="{{ route('estados.show', $uf->transporte_etiqueta_uf) }}">
                            <i class="fas fa-eye me-1"></i>
                            <a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        window.addEventListener("load", function(event) {
            const datatablesSimple = document.getElementById('estdosDatatables');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple, {
                    searchable: true,
                    sortable: true,
                    paging: true
                });
            }
        }, false);
    </script>

</x-app-layout>
