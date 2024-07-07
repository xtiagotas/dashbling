<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            produtos mais vendidos
        </div>
        <div class="card-body">
            <table id="ProutosMaisVendidosDatatables">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Descricao</th>
                        <th>Vendas</th>
                        <th>Est. Min.</th>
                        <th>Est. Max.</th>
                        <th>Estoque</th>
                        {{-- <th>Estoque R$</th> --}}
                        <th>Custo</th>
                        <th>preco</th>
                        <th>Margem</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtosMaisVendidos as $produto)
                        <tr>
                            <td>{{ $produto->codigo }}</td>
                            <td>{{ substr($produto->nome, 0, 35) }}</td>
                            <td>{{ $produto->quantidade }}</td>
                            <td>{{ $produto->estoque_minimo }}</td>
                            <td>{{ $produto->estoque_maximo }}</td>
                            <td>{{ $produto->estoque }}</td>
                            {{-- <td>{{ $formatter->formatCurrency($produto->estoque, 'BRL') }}</td> --}}
                            {{-- <td>{{ $formatter->formatCurrency($produto->quantidade * $produto->precoCusto, 'BRL') }}</td> --}}
                            <td>{{ $formatter->formatCurrency($produto->precoCusto, 'BRL') }}</td>
                            <td>{{ $formatter->formatCurrency($produto->preco, 'BRL') }}</td>
                            <td>{{ number_format($produto->margem, 2) }} %</td>
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
        const datatablesSimple = document.getElementById('ProutosMaisVendidosDatatables');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
                searchable: true,
                sortable: true,
                paging: true
            });
        }
    }, false);
</script>
