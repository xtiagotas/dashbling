{{-- <div class="card mb-4">
    <div class="card-body"> --}}
        <form method="get" action="{{ route('vendas.index') }}">
            <div class="row mb-3">
                <div class="col-lg-4">
                    {{-- <x-input-label for="client_id" :value="__('Canais de venda')" /> --}}
                    {{-- <select multiple id="situacao_id" class="form-control" name="situacao_id"> --}}
                    <select id="situacao_id" class="form-control" name="situacao_id">
                        <option value="0">Todas as situações</option>
                        @foreach ($situacoes_filter as $situacao)
                            <option value="{{ $situacao->bling_id }}"
                                {{ $situacao->bling_id == $situacao_id ? 'selected' : '' }}>{{ $situacao->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-lg-4">
                    {{-- <x-input-label for="client_id" :value="__('Canais de venda')" /> --}}
                    {{-- <select multiple id="canal_venda_id" class="form-control" name="canal_venda_id"> --}}
                    <select id="canal_venda_id" class="form-control" name="canal_venda_id">
                        <option value="0">Toos os canais</option>
                        @foreach ($lojas_filter as $loja)
                            <option value="{{ $loja->bling_id }}" {{ $loja->bling_id == $canal_venda_id ? 'selected' : '' }}>
                                {{ $loja->tipo }} - {{ $loja->descricao }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-lg-4">
                    <div class="input-group">
                        {{-- <x-input-label for="client_secret" :value="__('Período')" /> --}}
                        <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Período" />
                        <button class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </div>
        </form>
    {{-- </div>
</div> --}}




<script>
    window.addEventListener("load", function(event) {
        const data_de = Date.parse("{{ $periodo_de }}");
        const data_ate = Date.parse("{{ $periodo_ate }}");

        const picker = new Litepicker({
            element: document.getElementById('periodo'),
            singleMode: false,
            // allowRepick: true,
            plugins: ['ranges'],
            format: 'DD/MM/YYYY',
            startDate: data_de,
            endDate: data_ate,
            numberOfMonths: 2,
            numberOfColumns: 2,
            autoApply: false
            // showOn: 'both',
        });
    }, false);
</script>
