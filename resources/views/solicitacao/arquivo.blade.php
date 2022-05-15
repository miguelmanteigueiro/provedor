<x-layout>
    @if ($solicitacoes->count())
    <div class="w3-responsive w3-section">
        <x-load-arquivadas :solicitacoes="$solicitacoes" />

        <div class="w3-section">
            {{ $solicitacoes->links() }}
        </div>
    </div>
    @else
        <h1 class="w3-center w3-display-middle">Não existem solicitações arquivadas ou encerradas.</h1>
    @endif
</x-layout>