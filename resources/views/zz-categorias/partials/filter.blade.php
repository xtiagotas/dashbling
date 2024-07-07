{{-- <form id="formFilter" action="#"> --}}
<form method="get" action="{{route('vendas.teste')}}" >
    <div class="row mb-3">
        <div class="col-lg-4">
            {{-- <x-input-label for="client_id" :value="__('Canais de venda')" /> --}}
            <select id="situacao_id" class="form-control" name="situacao_id">
                <option value="0">Todas as situações</option>
                @foreach ($situacoes_filter as $situacao)
                    <option value="{{$situacao->bling_id}}">{{$situacao->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4">
            {{-- <x-input-label for="client_id" :value="__('Canais de venda')" /> --}}
            <select id="canal_venda_id" class="form-control" name="canal_venda_id">
                <option value="0">Toos os canais</option>
                @foreach ($lojas_filter as $loja)
                    <option value="{{$loja->bling_id}}">{{$loja->tipo}} - {{$loja->descricao}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4">
            <div class="input-group">
                {{-- <x-input-label for="client_secret" :value="__('Período')" /> --}}
                <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Período"  />
                <button class="btn btn-primary">Filtrar</button>
            </div>
        </div>

        {{-- <div class="col-lg-1">
            <button class="btn btn-primary btn-user btn-block">Filtrar</button>
        </div>

        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div> --}}
    </div>
</form>
{{-- </form> --}}

<script>
    window.addEventListener("load", function(event) {
        new Litepicker({
            element: document.getElementById('periodo'),
            plugins: ['ranges'],
            format: 'DD/MM/YYYY',
        });
    }, false);
</script>

<br />
<br />