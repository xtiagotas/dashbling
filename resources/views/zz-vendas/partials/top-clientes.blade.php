<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-bookmark me-1"></i>
            Top 5 Clientes
        </div>
        {{-- <div class="card-body"> --}}
        <table id="topClientesDatatables">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Qtd. Pedidos</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ substr($cliente->nome, 0, 40) }}</td>
                        <td>{{ $cliente->qtd }}</td>
                        <td>{{ $formatter->formatCurrency($cliente->val, 'BRL') }}</td>
                        <td>
                            <div style="text-align: center">
                                <a href="{{ route('clientes.show', $cliente->bling_id) }}">
                                    <i class="fas fa-eye me-1"></i>
                                    <a>
                            </div>
                        </td>
                    <tr>
                @endforeach
            </tbody>
        </table>
        {{-- </div> --}}

    </div>
</div>

<script>
    window.addEventListener("load", function(event) {
        const datatablesSimple = document.getElementById('topClientesDatatables');
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
