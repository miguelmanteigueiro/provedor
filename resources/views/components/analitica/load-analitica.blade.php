@props(['solicitacoes'])

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID</th>
        <th>Referência</th>
        <th>Forma de Apresentação</th>
        <th>Forma de Contacto</th>
        <th>Tipo de Solicitação</th>
        <th>Estado</th>
        <th>Data de Início</th>
        <th>Opções</th>
    </tr>

    @foreach ($solicitacoes as $solicitacao)
        <x-analitica.preencher-tabela :solicitacao="$solicitacao" />
    @endforeach
</table>
