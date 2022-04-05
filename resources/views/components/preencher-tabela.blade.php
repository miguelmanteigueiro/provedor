@props(['solicitacao'])

{{-- {{ dd($solicitacao->user) }} --}}

<tr>
    <td> {{ $solicitacao->solicitacao_id }} </td>
    <td> XX</td>
    <td> {{ $solicitacao->user->nome }} </td>
    <td> {{ $solicitacao->estudante_id }} </td>
    <td> {{ $solicitacao->estudante_nome }} </td>
    <td> {{ $solicitacao->estudante_email }} </td>
    <td> {{ $solicitacao->estudante_telefone }} </td>
    <td> <x-botao-tabela function="Consultar" /> </td>
    <td> <x-botao-tabela function="Editar" /> </td>
    <td> <x-botao-tabela function="Arquivar" /> </td>
</tr>