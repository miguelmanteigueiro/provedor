@props(['assunto'])

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID</th>
        <th>Natureza do Assunto</th>
        <th>Subcategoria</th>
        <th>Editar Assunto</th>
    </tr>
    @foreach ($assunto as $assunto)
        <x-assunto.preencher-tabela :assunto="$assunto" />
    @endforeach
</table>