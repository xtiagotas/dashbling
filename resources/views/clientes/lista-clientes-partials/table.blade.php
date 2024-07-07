<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Clientes
        </div>
        <div class="card-body">
            <table id="clientesDatatables">
                <thead>
                    <tr>
                        <th>Origem</th>
                        <th>Nome</th>
                        <th>Qtd Pedidos</th>
                        <th>Qtd Produtos</th>
                        <th>Ciclo (dias)</th>
                        <th>Total R$</th>
                        {{-- <th>Contribuição</th> --}}
                        {{-- <th>Pessoa</th> --}}
                        <th>Estado</th>
                        <th>Cidade</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->origem_cadastro }}</td> <!-- Origem -->
                            <td>{{ substr($cliente->nome, 0, 25) }}</td> <!-- Nome -->
                            <td>{{ $cliente->qtd_pedidos }}</td> <!-- Qtd Pedidos -->
                            <td>{{ $cliente->qtd_produtos }}</td> <!-- Qtd Produtos -->
                            <td>{{ $cliente->dias_ultima_venda }}</td> <!-- Ciclo de venda (dias) -->
                            <td>{{ $cliente->val }}</td></td> <!-- Total Faturado -->
                            {{-- <td>{{ '6.00 %' }}</td> <!-- Contribuição --> --}}
                            {{-- <td>{{ $cliente->tipo }}</td> --}}
                            <td>{{ $cliente->endereco_uf }}</td>
                            <td>{{ $cliente->endereco_municipio }}</td>
                            {{-- <td>
                                <div style="text-align: center">
                                    <a href="{{ route('clientes.show', $cliente->bling_id) }}">
                                        <i class="fas fa-eye me-1"></i>
                                        <a>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        const datatablesSimple = document.getElementById('clientesDatatables');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
                searchable: true,
                sortable: true,
                paging: true
            });
        }
    }, false);
</script>
