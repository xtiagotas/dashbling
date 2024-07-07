<x-app-layout>
    <h1 class="mt-4">Produtos</h1>
    {{-- <hr> --}}
    {{-- <ol class="breadcrumb mb-4"> --}}
    {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> --}}
    {{-- <li class="breadcrumb-item"><a href="{{route('categorias.index')}}">Categorias</a></li> --}}
    {{-- <li class="breadcrumb-item active">Produtos</li> --}}
    {{-- </ol> --}}

    {{-- @include('estoque.produtos-partials.cards') --}}
    {{-- 
    <div class="row">
        @include('estoque.produtos-partials.mais-vendidos')
    </div> --}}

    {{-- <div class="row">
        @include('estoque.produtos-partials.sem-vendas')
    </div> --}}

    {{-- <div class="row"> --}}
    {{-- @include('estoque.produtos-partials.depositos') --}}
    {{-- </div> --}}
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-dollar-sign me-1"></i>
                Recomendacao Compra
            </div>
            <div class="card-body">
                <table id="RecomendacaoCompraDatatables">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Descricao</th>
                            <th>Vendas mes passado</th>
                            <th>Est. Min.</th>
                            <th>Estoque</th>
                            <th>Recomendada</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->codigo }}</td>
                                <td>{{ substr($produto->nome, 0, 35) }}</td>
                                <td>{{ $produto->vendas_mes_passado }}</td>
                                <td>{{ $produto->estoque_minimo }}</td>
                                <td>{{ $produto->estoque }}</td>
                                <td>{{ $produto->quantidade_recomendada }}</td>
                                <td>
                                    <div style="text-align: center">
                                        <i class="fas fa-eye me-1" style="color: lightGray"></i>
                                        {{-- <a href="{{ route('produtos.show', $produto->codigo) }}">
                                            <i class="fas fa-eye me-1"></i>
                                            <a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", function(event) {
            const datatablesSimple = document.getElementById('RecomendacaoCompraDatatables');
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
