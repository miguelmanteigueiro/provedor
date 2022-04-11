<x-layout>
    <p> Solicitação: {{ $solicitacao->solicitacao_id }} </p>

    {!! nl2br(@$solicitacao->descricao) !!}
</x-layout>
