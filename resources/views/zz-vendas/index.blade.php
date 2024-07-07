<x-app-layout>
    <h1 class="mt-4">Vendas</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Vendas</li>
    </ol> --}}

    @include('vendas.partials.filter')

    <div class="row">
        @include('vendas.partials.cards')
    </div>

    @include('vendas.partials.fat-diario')

    @include('vendas.partials.lucro')

    {{-- @include('vendas.partials.canais') --}}

    <div class="row">
        @include('vendas.partials.top-estados')
        @include('vendas.partials.top-canais-venda')
    </div>

    <div class="row">
        @include('vendas.partials.top-clientes')
        @include('vendas.partials.top-produtos')
    </div>

    {{-- <div class="row">
        @include('vendas.partials.descontos-mensais')
    </div> --}}

    {{-- @include('vendas.partials.pedidos-table') --}}

</x-app-layout>
