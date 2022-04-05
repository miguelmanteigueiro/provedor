<x-layout>
    @if ($solicitacoes->count())
        <x-load-solicitacoes :solicitacoes="$solicitacoes" />
    @else
        <h1 class="w3-center w3-display-middle">Não existem solicitações.</h1>
    @endif
</x-layout>
