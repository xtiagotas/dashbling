<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fas fa-tag me-1"></i>
            Top 5 Produtos
        </div>
        <table id="topProdDatatables">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Descricao</th>
                    <th>QTd. Vendida</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->sku }}</td>
                        <td>{{ substr($produto->nome, 0, 15) }}</td>
                        <td>{{ $produto->qtd }}</td>
                        <td>{{ $formatter->formatCurrency($produto->val, 'BRL') }}</td>
                        <td>
                            <div style="text-align: center">
                                <i class="fas fa-eye me-1" style="color: lightGray"></i>
                                {{-- <a href="{{ route('produtos.show', $produto->sku) }}">
                                    <i class="fas fa-eye me-1"></i>
                                    <a> --}}
                            </div>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
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
        {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
    </div>
</div>
