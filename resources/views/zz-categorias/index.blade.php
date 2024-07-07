<x-app-layout>
    <h3 class="mt-3">Categorias</h3>
    <hr>
    {{-- <div class="row"> --}}
        {{-- <label style="color:white">.</label> --}}
    {{-- </div> --}}

    {{-- <div class="row"> --}}
        {{-- @include('vendas.partials.filter') --}}
    {{-- </div> --}}
    {{-- <p>
        <b>QTD Clategorias: </b> {{ $qtdCategorias }}
    </p> --}}

    <table id="catDatatables">
        <thead>
            <tr>
                <th>id</th>
                <th>Categoria Pai</th>
                <th>descricao</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->bling_id }}</td>
                    <td>{{ $categoria->categoriaPai }}</td>
                    <td>{{ $categoria->descricao }}</td>
                    <td>
                        <div style="text-align: center">
                            <a href="{{ route('categorias.show', $categoria->bling_id) }}">
                                <i class="fas fa-eye me-1"></i>
                                <a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.addEventListener("load", function(event) {
            const datatablesSimple = document.getElementById('catDatatables');
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
