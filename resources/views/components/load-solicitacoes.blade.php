@props(['solicitacoes'])

<div class="w3-responsive w3-section">
    <table class="w3-table-all">
        <tr>
          <th>ID</th>
          <th>Referência</th>
          <th>Criado Por</th>
          <th>Nº de Estudante</th>
          <th>Nome do Estudante</th>
          <th>Endereço de Email</th>
          <th>Contacto Telefónico</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($solicitacoes as $solicitacao)
            <x-preencher-tabela :solicitacao="$solicitacao" />
        @endforeach
    </table>
</div>
