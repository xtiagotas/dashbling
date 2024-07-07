<section>
    <header>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Token Api Bling') }}
        </h3>
    </header>

    <form method="post" action="{{ route('authorize.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group row">
            <div class="col-sm-5 mb-3 mb-sm-0">
                <x-input-label for="client_id" :value="__('Client Id')" />
                <x-text-input id="client_id" class="form-control form-control-user" type="text" name="client_id" :value="old('client_id')" required autofocus autocomplete="client_id" placeholder="Client Id" value="{{$bling_token->client_id ?? ''}}"/>
                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
            </div>
            <div class="col-sm-7 mb-3 mb-sm-0">
                <x-input-label for="client_secret" :value="__('Client Secret')" />
                <x-text-input id="client_secret" class="form-control form-control-user" type="text" name="client_secret" :value="old('client_secret')" required autofocus autocomplete="client_secret" placeholder="Client Secret" value="{{$bling_token->client_secret ?? ''}}"/>
                <x-input-error :messages="$errors->get('client_secret')" class="mt-2" />
            </div>
            {{-- <div class="col-sm-2 mb-3 mb-sm-0">
                <button class="btn btn-primary">Save</button>
            </div> --}}
        </div>
        <br />
        <button class="btn btn-primary">
            Save
        </button>

    </form>
</section>
