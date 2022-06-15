@props(['logs'])

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID <i>Log</i></th>
        <th>ID Solicitação</th>
        <th>Utilizador</th>
        <th>Data de Edição</th>
        <th>Motivo de Edição</th>
    </tr>

    @foreach($logs as $log)
        <x-admin.preencher-tabela :log="$log" />
    @endforeach
</table>
