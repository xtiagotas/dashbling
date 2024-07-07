<x-app-layout>
    <h1 class="mt-4">Clientes</h1>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="nome" name="nome" type="text" value="{{ $contato->nome }}"
                        readonly disabled />
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="tipo" name="tipo" type="text"
                        value="{{ $contato->tipo == 'J' ? 'PESSOA JURIDICA' : 'PESSOA FISICA' }}" readonly disabled />
                    <label for="tipo">Tipo</label>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-floating">
                    <input class="form-control" id="estado" name="estado" type="text"
                        value="{{ $contato->endereco_uf }}" readonly disabled />
                    <label for="estado">Estado</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="cidade" name="cidade" type="text"
                        value="{{ $contato->endereco_municipio }}" readonly disabled />
                    <label for="cidade">Cidade</label>
                </div>
            </div>
        </div>
    </div>
    <hr>

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
                            searchable: false,
                            // sortable: false,
                            perPageSelect: false,
                            paging: false
                        });
                    }
                }, false);
            </script>
            {{-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> --}}
        </div>
    </div>






    {{-- @foreach ($pedidos as $pedido)
        {{ $pedido }}
        <br />
        <br />
    @endforeach --}}

    {{-- @include('clientes.partials.pedidos-table') --}}


</x-app-layout>
