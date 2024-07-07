<x-app-layout>
    <div class="row">
        <label style="color:white">.</label>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('settings.partials.update-assinatura-form')
                </div>
            </div>
            <br />

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('settings.partials.update-bling-token-form')
                </div>
            </div>

            <br />
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('settings.partials.update-bling-lojas-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
