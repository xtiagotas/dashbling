<x-app-layout>
    <h3 class="mt-3">Categorias</h3>
    {{-- <h3 class="mt-3">{{$categoria->descricao}}</h3> --}}
    <hr>
    {{-- <h1 class="mt-4">Charts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Charts</li>
    </ol> --}}

    {{-- <h1 class="mt-4">{{$categoria->descricao}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('categorias.index')}}">Categorias</a></li>
        <li class="breadcrumb-item active">{{$categoria->descricao}}</li>
    </ol> --}}
    {{ $categoria }}
    <hr>

    @include('categorias.partials.produtos')
    {{-- @include('produtos.partials.pedidos-table') --}}
</x-app-layout>
