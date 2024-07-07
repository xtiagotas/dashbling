<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            produtos sem vendas
        </div>
        <div class="card-body">
            <table id="ProdutosNaoVendidosDatatables">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>descricao</th>
                        {{-- <th>Est. Min.</th>
                        <th>Est. Max.</th> --}}
                        <th>Estoque</th>
                        <th>Estoque R$</th>
                        <th>Custo</th>
                        <th>preco</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtosNaoVendidos as $produto)
                        <tr>
                            <td>{{ $produto->codigo }}</td> <!-- SKU -->
                            <td>{{ substr($produto->nome, 0, 35) }}</td>
                            {{-- <td>{{ $produto->estoque_minimo }}</td>
                            <td>{{ $produto->estoque_maximo }}</td> --}}
                            <td>{{ $produto->estoque }}</td> <!-- Estoque -->
                            <td>{{ $formatter->formatCurrency($produto->estoque * $produto->precoCusto, 'BRL') }}
                            <td>{{ $formatter->formatCurrency($produto->precoCusto, 'BRL') }}</td>
                            <td>{{ $formatter->formatCurrency($produto->preco, 'BRL') }}</td>
                            </td>
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
        const datatablesSimple = document.getElementById('ProdutosNaoVendidosDatatables');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
                searchable: true,
                sortable: true,
                paging: true
            });
        }
    }, false);
</script>
