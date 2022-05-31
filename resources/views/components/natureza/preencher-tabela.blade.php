@props(['natureza'])

<tr>
    <td> {{ $natureza->natureza_id }} </td>
    <td> {{ $natureza->descricao }} </td>
    <td> <x-botao-tabela function="Editar Natureza" id="{{ $natureza->natureza_id }}" /> </td>
</tr>