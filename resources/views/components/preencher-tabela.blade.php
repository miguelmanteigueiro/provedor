@props(['solicitacao'])

<tr>
    <td> {{ $solicitacao->solicitacao_id }} </td>
    <td> {!! !empty($solicitacao->referencia_interna) ? $solicitacao->referencia_interna : "Não existe" !!} </td>
    <td> {{ $solicitacao->user->nome }} </td>
    <td> {!! !empty($solicitacao->estudante_id) ? $solicitacao->estudante_id: "N/A" !!} </td>
    <td> {{ $solicitacao->estudante_nome }} </td>
    <td> {{ $solicitacao->estudante_email }} </td>
    <td> {!! !empty($solicitacao->estudante_telefone) ? $solicitacao->estudante_telefone: "N/A" !!} </td>
    <td> <x-botao-tabela function="Consultar" id="{{ $solicitacao->solicitacao_id }}" /> </td>
    <td> <x-botao-tabela function="Editar" id="{{ $solicitacao->solicitacao_id }}" /> </td>
    <td> <x-botao-tabela function="Arquivar" id="{{ $solicitacao->solicitacao_id }}" /> </td>
</tr>