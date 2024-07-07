<x-app-layout>
    <h1 class="mt-4">Canais de venda</h1>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="codigo" name="codigo" type="text" value="{{ $loja->bling_id }}"
                        readonly disabled />
                    <label for="codigo">Codigo</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="tipo" name="tipo" type="text" value="{{ $loja->tipo }}"
                        readonly disabled />
                    <label for="tipo">Tipo</label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="descricao" name="descricao" type="text" value="{{ $loja->descricao }}"
                        readonly disabled />
                    <label for="descricao">Descricao</label>
                </div>
            </div>
            {{-- <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="tipo" name="tipo" type="text"
                        value="{{ $loja->tipo == 'J' ? 'PESSOA JURIDICA' : 'PESSOA FISICA' }}" readonly disabled />
                    <label for="tipo">Tipo</label>
                </div>
            </div> --}}
            {{-- <div class="col-md-1">
                <div class="form-floating">
                    <input class="form-control" id="estado" name="estado" type="text"
                        value="{{ $loja->endereco_uf }}" readonly disabled />
                    <label for="estado">Estado</label>
                </div>
            </div> --}}
            {{-- <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="cidade" name="cidade" type="text"
                        value="{{ $loja->endereco_municipio }}" readonly disabled />
                    <label for="cidade">Cidade</label>
                </div>
            </div> --}}
        </div>
    </div>

    <hr>
    <section>
        <span>Pedidos do canal aqui</span>
    </section>

    <hr>
    <section>
        <span>Produtos do canal aqui</span>
    </section>

    <hr>
    <section>
        <span>Categorias do canal aqui</span>
    </section>

    <hr>
    <section>
        <span>Clientes do canal aqui</span>
    </section>

    <hr>
    <section>
        <span>Vendedores do canal aqui</span>
    </section>

    {{-- @include('produtos.partials.clientes-table')
    @include('produtos.partials.pedidos-table') --}}
</x-app-layout>
