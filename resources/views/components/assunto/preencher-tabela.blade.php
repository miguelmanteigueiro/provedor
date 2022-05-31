@props(['assunto'])

<tr>
    <td> {{ $assunto->assunto_id }} </td>
    <td> {{ $assunto->natureza->descricao }} </td>
    <td> {{ $assunto->subcategoria }} </td>
    <td> <x-botao-tabela function="Editar Assunto" id="{{ $assunto->assunto_id }}" /> </td>
</tr>