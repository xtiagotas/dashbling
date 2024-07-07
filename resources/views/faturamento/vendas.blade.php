<x-app-layout>
    <h1 class="mt-4">Vendas</h1>

    {{-- @include('faturamento._partials.filter') --}}

    <div class="row">
        @include('faturamento.vendas-partials.cards')
    </div>

    @include('faturamento.vendas-partials.fat-diario')

    @include('faturamento.vendas-partials.lucro')

    <div class="row">
        @include('faturamento.vendas-partials.top-estados')
        @include('faturamento.vendas-partials.top-canais-venda')
    </div>

    <div class="row">
        @include('faturamento.vendas-partials.top-clientes')
        @include('faturamento.vendas-partials.top-produtos')
    </div>

    {{-- <div class="row">
        @include('faturamento.vendas-partials.descontos-mensais')
    </div> --}}

    {{-- @include('faturamento.vendas-partials.pedidos-table') --}}

</x-app-layout>
