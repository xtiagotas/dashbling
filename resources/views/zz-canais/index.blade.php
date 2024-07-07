<x-app-layout>
    <h1 class="mt-4">Canais de venda</h1>
    {{-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Canais</li>
    </ol> --}}

    @include('canais.partials.canais')  

    <div class="row">
        @include('canais.partials.canais-mais-vendidos')  
    </div>

</x-app-layout>
