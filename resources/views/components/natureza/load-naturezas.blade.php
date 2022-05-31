@props(['natureza'])

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID</th>
        <th>Natureza do Assunto</th>
        <th>Editar Natureza</th>
    </tr>
    @foreach ($natureza as $natureza)
        <x-natureza.preencher-tabela :natureza="$natureza" />
    @endforeach
</table>