<x-app-layout>
    <h1 class="mt-4">Dashboard</h1>
    {{-- <ol class="breadcrumb mb-4"> --}}
    {{-- <li class="breadcrumb-item active">/ Dashboard /</li> --}}
    {{-- </ol> --}}

    <div class="row">
        @include('dashboard.partials.pedidos')
    </div>

    @include('dashboard.partials.fat-trinta-dias')

    <div class="row">
        @include('dashboard.partials.fat-doze-meses')
        @include('dashboard.partials.fat-cinco-anos')
    </div>

    <div class="row">
        @include('dashboard.partials.top-canais-venda')
        @include('dashboard.partials.clientes-venda-recorrente')
    </div>

    <div class='row'>
        @include('dashboard.partials.top-produtos')
        @include('dashboard.partials.top-estados')
    </div>
{{-- 
    <div class='row'>
        @include('dashboard.partials.tipo-pessoa')
    </div> --}}

</x-app-layout>
