<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Minha assinatura
        </h2>
    </header>

    <div class="mt-6 space-y-6">
        <div class="form-group row">
            @if (count($assinaturas) == 0)
                <div class="alert alert-danger">
                    <span>você ainda não possui uma assinatura Dashbling.</span>
                    <a href="javascript:document.querySelector('#form').submit();">Assine agora!</a>
                    <form action="{{ route('subscription.process') }}" method="POST" id="form">
                        @csrf
                    </form>
                </div>                
            @else
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>CRIADA EM</th>
                            <th>ATUALIZADA EM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assinaturas as $assinatura)
                            <tr>
                                <td> {{ $assinatura->stripe_id }} </td>
                                <td> {{ $assinatura->stripe_status }} </td>
                                <td> {{ $assinatura->created_at }} </td>
                                <td> {{ $assinatura->updated_at }} </td>
                                <td>
                                    @if ($assinatura->stripe_status == 'active')
                                        <a href="{{ route('subscription.showCancelConfirmForm') }}"
                                            class="btn btn-primary">
                                            Cancelar assinatura
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-secondary">
                                            Cancelar assinatura
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</section>
