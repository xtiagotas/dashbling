<!-- subscriptions/index.blade.php -->
<x-app-layout>

    {{-- @section('content') --}}
    <h1>Minhas Assinaturas</h1>

    @if ($subscriptions->isEmpty())
        <p>Você não possui assinaturas ativas.</p>
    @else
        <ul>
            @foreach ($subscriptions as $subscription)
                <li>
                    {{ $subscription->stripe_status }} <b>- {{ $subscription->stripe_price }} -</b> {{ $subscription->stripe_id }}
                    <form action="{{ route('subscriptions.cancel') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                        <button type="submit">Cancelar Assinatura</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</x-app-layout>
