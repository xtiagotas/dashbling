<x-app-layout>
    <h3 class="mt-3">Estados</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('estados.index')}}">Estados</a></li>
        <li class="breadcrumb-item active">{{$estado_uf}}</li>
    </ol>
    {{-- <hr> --}}
    {{-- <h1 class="mt-4">Charts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Charts</li>
    </ol> --}}

    {{-- <h1 class="mt-4">{{$estado_uf}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('estados.index')}}">Estados</a></li>
        <li class="breadcrumb-item active">{{$estado_uf}}</li>
    </ol> --}}
    {{-- {{ $loja }} --}}
    {{-- <hr> --}}

    {{-- @include('produtos.partials.clientes-table')
    @include('produtos.partials.pedidos-table') --}}
</x-app-layout>
