@props(['solicitacoes'])

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID</th>
        <th>Referência</th>
        <th>Criado Por</th>
        <th>Nº de Estudante</th>
        <th>Nome do Estudante</th>
        <th>Endereço de Email</th>
        <th>Contacto Telefónico</th>
        <th></th>
        <th>Opções</th>
        <th></th>
    </tr>
    @foreach ($solicitacoes as $solicitacao)
        <x-preencher-arquivo :solicitacao="$solicitacao" />
    @endforeach
</table>
