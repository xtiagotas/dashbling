<x-app-layout>
    <h1 class="mt-4">Produtos</h1>
    {{-- <hr> --}}
    {{-- <ol class="breadcrumb mb-4"> --}}
        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> --}}
        {{-- <li class="breadcrumb-item"><a href="{{route('categorias.index')}}">Categorias</a></li> --}}
        {{-- <li class="breadcrumb-item active">Produtos</li> --}}
    {{-- </ol> --}}

    @include('produtos.partials.cards')

    <div class="row">
        @include('produtos.partials.mais-vendidos')
    </div>

    <div class="row">
        @include('produtos.partials.sem-vendas')
    </div>

    <div class="row">
        @include('produtos.partials.depositos')
        {{-- @include('produtos.partials.produtos-ncm') --}}
    </div>
</x-app-layout>
