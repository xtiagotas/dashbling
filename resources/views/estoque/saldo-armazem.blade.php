<x-app-layout>
    <h1 class="mt-4">Produtos</h1>
    {{-- <hr> --}}
    {{-- <ol class="breadcrumb mb-4"> --}}
        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li> --}}
        {{-- <li class="breadcrumb-item"><a href="{{route('categorias.index')}}">Categorias</a></li> --}}
        {{-- <li class="breadcrumb-item active">Produtos</li> --}}
    {{-- </ol> --}}

    @include('estoque.produtos-partials.cards')

    {{-- <div class="row">
        @include('estoque.produtos-partials.mais-vendidos')
    </div> --}}

    {{-- <div class="row">
        @include('estoque.produtos-partials.sem-vendas')
    </div> --}}

    <div class="row">
        @include('estoque.produtos-partials.depositos')
    </div>
</x-app-layout>
