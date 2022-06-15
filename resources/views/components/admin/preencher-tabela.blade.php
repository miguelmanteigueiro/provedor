@props(['log'])

<tr>
    <td> {{ $log->log_id }}</td>
    <td> {{ $log->solicitacao_id }}</td>
    <td> {{ \App\Models\User::find($log->utilizador_id)->nome }}</td>
    <td> {{ $log->data_edicao }}</td>
    <td> {{ $log->motivo_edicao }}</td>
</tr>

