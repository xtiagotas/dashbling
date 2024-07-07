<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-dollar-sign me-1"></i>
            Canais mais vendas
        </div>
        <div class="card-body">
            <table id="canaisDatatables">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descricao</th>
                        <th>1ª Venda</th>
                        <th>Ult. Venda</th>
                        <th>Dias S/ Vender</th>
                        <th>Faturamento</th>
                        <th>Pedidos</th>
                        <th>Contribuição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canaisMaisVendidos as $canal)
                        <tr>
                            <td>{{ $canal->tipo }}</td> <!-- Id -->
                            <td>{{ $canal->descricao }}</td> <!-- Id -->
                            <td>{{ $canal->primeira_venda }}</td> <!-- 1ª Venda -->
                            <td>{{ $canal->ultima_venda }}</td> <!-- Ult. Venda -->
                            <td>{{ $canal->dias_ultima_venda }}</td> <!-- Ult. Venda -->
                            <td>{{ $formatterCurrency->formatCurrency($canal->faturamento, 'BRL') }}</td>
                            <td>{{ $canal->quantidade }}</td> <!-- Pedidos -->
                            <td>{{ number_format($canal->contribuicao, 2, ',', '.') }} %</td>
                            <td>
                                <div style="text-align: center">
                                    <i class="fas fa-eye me-1" style="color: lightGray"></i>
                                    {{-- <a href="{{ route('canais.show', $canal->bling_id) }}">
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
        const datatablesSimple = document.getElementById('canaisDatatables');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {
                searchable: true,
                sortable: true,
                paging: true
            });
        }
    }, false);
</script>
