@props(['solicitacao'])

<tr>
    <td> {{ $solicitacao->solicitacao_id }}</td>
    <td> {!! !empty($solicitacao->referencia_interna) ? $solicitacao->referencia_interna : "Não existe" !!} </td>
    <td> {!! !empty($solicitacao->analitica->apresentacao) ? $solicitacao->analitica->apresentacao : "N/A" !!} </td>
    <td> {!! !empty($solicitacao->analitica->forma_contacto) ? $solicitacao->analitica->forma_contacto : "N/A" !!} </td>
    <td> {!! !empty($solicitacao->analitica->tipo_solicitacao) ? $solicitacao->analitica->tipo_solicitacao : "N/A" !!} </td>
    <td> {!! !empty($solicitacao->estado_solicitacao->estado) ? $solicitacao->estado_solicitacao->estado : "N/A" !!} </td>
    <td> {!! !empty($solicitacao->estado_solicitacao->data_inicio) ? $solicitacao->estado_solicitacao->data_inicio : "N/A" !!} </td>
    <td> <x-botao-tabela function="Gerir Analítica" id="{{ $solicitacao->solicitacao_id }}" /> </td>
</tr>

