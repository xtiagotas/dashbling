<x-app-layout>
    <h1 class="mt-4">Clientes</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol> --}}

    {{-- START CLIENTES NOVOS E RECORRENTES --}}
    <div class="row">
        @include('clientes.partials.cards') 
    </div>

    <div class="row">
        {{-- @include('clientes.partials.tipo-cliente')  --}}
        @include('clientes.partials.estados') 
        @include('clientes.partials.tipo-pessoa') 
    </div>

    {{-- <div class="row"> --}}
        
        {{-- @include('clientes.partials.estados')  --}}
    {{-- </div> --}}

    @include('clientes.partials.table') 

</x-app-layout>
