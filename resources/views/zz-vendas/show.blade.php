<x-app-layout>
    <h1 class="mt-4">Vendas</h1>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="numero" name="numero" type="text" value="{{ $pedido->numero }}"
                        readonly disabled />
                    <label for="numero">Numero</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input class="form-control" id="contato" name="contato" type="text"
                        value="{{ $pedido->contato_nome }}" readonly disabled />
                    <label for="contato">Cliente</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="loja" name="loja" type="text"
                        value="{{ $pedido->loja_id }}" readonly disabled />
                    <label for="loja">Loja</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="transporte_contato_nome" name="transporte_contato_nome"
                        type="text" value="{{ $pedido->transporte_contato_nome }}" readonly disabled />
                    <label for="transporte_contato_nome">Transportador</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="totalProdutos" name="totalProdutos" type="text"
                        value="{{ $pedido->totalProdutos }}" readonly disabled />
                    <label for="totalProdutos">Produtos</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="transporte_frete" name="transporte_frete" type="text"
                        value="{{ $pedido->transporte_fretePorConta + $pedido->transporte_frete }}" readonly disabled />
                    <label for="transporte_frete">Frete</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="desconto" name="desconto" type="text"
                        value="{{ $pedido->desconto }}" readonly disabled />
                    <label for="desconto">Descontos</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="outrasDespesas" name="outrasDespesas" type="text"
                        value="{{ $pedido->outrasDespesas }}" readonly disabled />
                    <label for="outrasDespesas">Outras Despesas</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="impostos" name="impostos" type="text"
                        value="{{ $pedido->tributacao_totalICMS + $pedido->tributacao_totalIPI }}" readonly disabled />
                    <label for="impostos">Impostos</label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="total" name="total" type="text"
                        value="{{ $pedido->total }}" readonly disabled />
                    <label for="total">Total</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="numeroLoja" name="numeroLoja" type="text"
                        value="{{ $pedido->numeroLoja }}" readonly disabled />
                    <label for="numeroLoja">Pedido Canal de Venda</label>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fas fa-tag me-1"></i>
                Itens do pedido
            </div>
            <table id="ProdutosDatatables">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Descricao</th>
                        <th>QTd. Vendida</th>
                        <th>Custo</th>
                        <th>Valor</th>
                        <th>Desconto</th>
                        <th>total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itens as $item)
                        <tr>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ substr($item->descricao, 0, 15) }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>{{ $formatter->formatCurrency($item->produto->precoCusto, 'BRL') }}</td>
                            <td>{{ $formatter->formatCurrency($item->valor, 'BRL') }}</td>
                            <td>{{ $formatter->formatCurrency($item->desconto, 'BRL') }}</td>
                            <td>{{ $formatter->formatCurrency($item->quantidade * $item->valor - ($item->quantidade * $item->produto->precoCusto + $item->desconto), 'BRL') }}
                            </td>
                            <td>
                                <div style="text-align: center">
                                    <i class="fas fa-eye me-1" style="color: lightGray"></i>
                                    {{-- <a href="{{ route('produtos.show', $item->codigo) }}">
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
                    const datatablesSimple = document.getElementById('ProdutosDatatables');
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
        </div>
    </div>
</x-app-layout>
