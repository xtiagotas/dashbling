<x-app-layout>
    <h1 class="mt-4">Produtos</h1>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="codigo" name="codigo" type="text" value="{{ $produto->codigo }}"
                        readonly disabled />
                    <label for="codigo">Codigo</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="nome" name="nome" type="text"
                        value="{{ $produto->nome }}" readonly disabled />
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="marca" name="cidade" type="text"
                        value="{{ $produto->marca }}" readonly disabled />
                    <label for="marca">Marca</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="getin" name="getin" type="text"
                        value="{{ $produto->getin }}" readonly disabled />
                    <label for="getin">GTIN</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="categoria" name="categoria" type="text"
                        value="{{ $produto->categoria }}" readonly disabled />
                    <label for="categoria">Categoria</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="estoque" name="estoque" type="text"
                        value="{{ $produto->estoque }}" readonly disabled />
                    <label for="estoque">Estoque</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="estoque_minimo" name="estoque_minimo" type="text"
                        value="{{ $produto->estoque_minimo }}" readonly disabled />
                    <label for="estoque_minimo">Estoque Minimo</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="estoque_maximo" name="estoque_maximo" type="text"
                        value="{{ $produto->estoque_maximo }}" readonly disabled />
                    <label for="estoque_maximo">Estoque Maximo</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="precoCompra" name="precoCompra" type="text"
                        value="{{ $produto->precoCompra }}" readonly disabled />
                    <label for="precoCompra">Preco Compra</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="precoCusto" name="precoCusto" type="text"
                        value="{{ $produto->precoCusto }}" readonly disabled />
                    <label for="precoCusto">Preco Custo</label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="preco" name="preco" type="text"
                        value="{{ $produto->preco }}" readonly disabled />
                    <label for="preco">Preço Venda</label>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="margemValor" name="margemValor" type="text"
                        value="{{ $produto->preco - $produto->precoCusto }}" readonly disabled />
                    <label for="margemValor">Margem R$</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input class="form-control" id="margemPercent" name="margemPercent" type="text"
                        value="{{ number_format((($produto->preco - $produto->precoCusto) / $produto->preco) * 100, 2, ',', '.') }}"
                        readonly disabled />
                    <label for="margemPercent">Margem %</label>
                </div>
            </div>

        </div>
    </div>

    <hr>
    <section>
        <span>Pedidos do produto aqui</span>
    </section>

    <hr>
    <section>
        <span>Canais de vendas aqui</span>
    </section>

    <hr>
    <section>
        <span>Clientes aqui</span>
    </section>

    <hr>
    <section>
        <span>Depósitos aqui</span>
    </section>

    <hr>
    <section>
        <span>Vendedores aqui</span>
    </section>

    {{-- @include('produtos.partials.clientes-table')
    @include('produtos.partials.pedidos-table') --}}
</x-app-layout>
