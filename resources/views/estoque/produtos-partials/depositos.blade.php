<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fas fa-tag me-1"></i>
            Depositos
        </div>
        <table id="topProdDatatables">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descricao</th>
                    <th>Qtd. Produtos</th>
                    <th>Valor Produtos</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($estoques as $estoque)
                    <tr>
                        <td>{{ $estoque->bling_id }}</td>
                        <td>{{ substr($estoque->descricao, 0, 20) }}</td>
                        <td>{{ number_format($estoque->qtd, 0, ',', '.') }}</td>
                        <td>{{ $formatter->formatCurrency($estoque->val, 'BRL') }}</td>
                        {{-- <td>
                            <div style="text-align: center">
                                <a href="{{ route('produtos.show', $produto->sku) }}">
                                    <i class="fas fa-eye me-1"></i>
                                    <a>
                            </div>
                        </td> --}}
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        const datatablesSimple = document.getElementById('topProdDatatables');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
                searchable: false,
                sortable: false,
                perPageSelect: false,
                paging: false
            });
        }
    }, false);
</script>
