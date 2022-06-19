<x-layout>
    <div class="w3-section w3-row-padding">
        <h2 class="w3-twothird">Página Inicial</h2>
        <div class="w3-third">
            <form method="GET" action="#">
                <input  type="text" 
                        name="search" 
                        placeholder="Pesquisar por referência, nome ou email" 
                        class="w3-input w3-border w3-round w3-margin-top"
                        value="{{ request('search') }}">
            </form>
        </div>
    </div>

    @if ($solicitacoes->count())
    <div class="w3-responsive w3-section">
        <x-load-solicitacoes :solicitacoes="$solicitacoes" />

        <div class="w3-section">
            {{ $solicitacoes->links() }}
        </div>
    </div>
    @else
        @if (request('search'))
            <h1 class="w3-center w3-display-middle">Não existem solicitações para a filtragem efetuada.</h1>
        @else
            <h1 class="w3-center w3-display-middle">Não existem solicitações em aberto.</h1>
        @endif
    @endif
</x-layout>
