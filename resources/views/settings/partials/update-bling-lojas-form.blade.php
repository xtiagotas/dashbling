<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Lojas Bling') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your Lojas information.") }}
        </p> --}}
    </header>

    <form method="post" action="{{ route('seetings.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo Loja</th>
                        <th>Tipo</th>
                        <th>Nome Loja</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bling_lojas as $loja)
                        <tr>
                            <td>
                                <x-text-input id="loja_id_{{$loja->bling_id}}" class="form-control form-control-user" type="text" name="loja_id_{{$loja->bling_id}}" :value="old('loja_id_{{$loja->bling_id}}')"  autofocus autocomplete="loja_id_{{$loja->bling_id}}" placeholder="loja Id_{{$loja->bling_id}}" value="{{$loja->bling_id ?? ''}}" disabled/>
                                <x-input-error :messages="$errors->get('loja_id_{{$loja->descricao}}')" class="mt-2" />
                            </td>
                            <td>
                                <x-text-input id="loja_tipo_{{$loja->bling_id}}" class="form-control form-control-user" type="text" name="loja_tipo_{{$loja->bling_id}}" :value="old('loja_tipo_{{$loja->bling_id}}')"  autofocus autocomplete="loja_tipo_{{$loja->bling_id}}" placeholder="loja_tipo_{{$loja->bling_id}}" value="{{$loja->tipo ?? ''}}" disabled/>
                                <x-input-error :messages="$errors->get('loja_tipo_{{$loja->tipo}}')" class="mt-2" />
                            </td>
                            <td>
                                <x-text-input id="loja_nome_{{$loja->bling_id}}" class="form-control form-control-user" type="text" name="loja_nome_{{$loja->bling_id}}" :value="old('loja_nome_{{$loja->bling_id}}')"  autofocus autocomplete="loja_nome_{{$loja->bling_id}}" placeholder="loja nome_{{$loja->bling_id}}" value="{{$loja->descricao ?? ''}}"/>
                                <x-input-error :messages="$errors->get('loja_nome_{{$loja->bling_id}}')" class="mt-2" />
                            </td>
                        <tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary">
            Save
        </button>

    </form>
</section>
