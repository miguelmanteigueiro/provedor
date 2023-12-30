<x-layout>
    <div class="w3-section w3-row-padding">
        <h2 class="w3-twothird">Arquivo</h2>
        <div class="w3-third">
            <form method="GET" action="#">
                <input  type="text" 
                        name="search" 
                        placeholder="Referência, nome, email, data de inserção" 
                        class="w3-input w3-border w3-round w3-margin-top"
                        value="{{ request('search') }}">
            </form>
        </div>
    </div>

    @if ($solicitacoes->count())
    <div class="w3-responsive w3-section">
        <x-load-arquivadas :solicitacoes="$solicitacoes" />

        <div class="w3-section">
            {{ $solicitacoes->links() }}
        </div>
    </div>
    @else
        @if (request('search'))
            <h1 class="w3-center w3-display-middle">Não existem solicitações para a filtragem efetuada.</h1>
        @else
            <h1 class="w3-center w3-display-middle">Não existem solicitações arquivadas.</h1>
        @endif
    @endif
</x-layout>
