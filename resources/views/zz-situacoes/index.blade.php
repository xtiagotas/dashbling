<x-app-layout>
    <div class="row">
		<label style="color:white">.</label>
    </div>
    
    <div class="row">
        @include('situacoes.partials.cards') 
    </div>
            
    {{-- <p>
        <b>QTD Status: </b> {{$qtdSituacoes}}
    </p>

    <table>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>cor</th>
        </tr>
        @foreach ($situacoes as $situacao)
            <tr>
                <td>{{$situacao->id}}</td>
                <td>{{$situacao->nome}}</td>
                <td>{{$situacao->cor}}</td>
            </tr>
        @endforeach       
    </table> --}}

</x-app-layout>