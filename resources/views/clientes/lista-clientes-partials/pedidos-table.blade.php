<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fas fa-tag me-1"></i>
            Pedidos
        </div>
        <div class="card-body">
            <table id="pedidosDatatables">
                <thead>
                    <tr>
                        <th>numero</th>
                        <th>Loja</th>
                        <th>data</th>
                        <th>Nome Cli.</th>
                        <th>tipo pessoa</th>
                        <th>Valor Bruto</th>
                        <th>Custos</th>
                        <th>Lucro</th>
                        <th>Lucro %</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->numero }}</td>
                            <td>{{ $pedido->loja()->descricao }}</td>
                            <td>{{ $pedido->data }}</td>
                            <td>{{ substr($pedido->contato_nome, 0, 15) }}</td>
                            <td>{{ $pedido->contato_tipoPessoa == 'J' ? 'Júridica' : 'Física' }}</td>
                            <td>{{ $pedido->total }}</td>
                            <td>{{ $pedido->totalCusto() }}</td>
                            <td>{{ $pedido->totalLucro() }}</td>
                            <td>{{ $pedido->totalLucroPercent() }} %</td>
                            <td>
                                <div style="text-align: center">
                                    <a href="{{ route('vendas.show', $pedido->numero) }}">
                                        <i class="fas fa-search-plus me-1"></i>
                                        <a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            window.addEventListener("load", function(event) {
                const datatablesSimple = document.getElementById('pedidosDatatables');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple, {
                        // searchable: false,
                        // sortable: false,
                        perPageSelect: false,
                        // paging: false
                    });
                }
            }, false);
        </script>
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>
</div>








{{-- <div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-desktop me-1"></i>
            Top 5 Canais de venda
        </div>
        <table id="datatablesSimplex2">
            <thead>
                <tr>
                    <th>id</th>
                    <th>numero</th>
                    <th>numero loja</th>
                    <th>data</th>
                    <th>total Produtos</th>
                    <th>total</th>
                    <th>tipo pessoa</th>
                    <th>situação</th>
                    <th>Loja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->numero }}</td>
                        <td>{{ $pedido->numeroLoja }}</td>
                        <td>{{ $pedido->data }}</td>
                        <td>{{ $pedido->totalProdutos }}</td>
                        <td>{{ $pedido->total }}</td>
                        <td>{{ $pedido->contato_id }}</td>
                        <td>{{ $pedido->situacao_id }}</td>
                        <td>{{ $pedido->loja()->descricao }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}

{{-- <script>
    window.addEventListener('DOMContentLoaded', event => {
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki

        const datatablesSimple = document.getElementById('datatablesSimplex2');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script> --}}
