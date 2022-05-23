<x-layout>
<div class="w3-section w3-row">
    <div class="w3-row">
        <div class="w3-container w3-twothird">
          <h2>Gestão de Contas</h2>
        </div>
        <div class="w3-right-align w3-margin-top w3-container w3-third">
            <form>
                <button formaction="/admin/contas/registar/" class="w3-btn w3-green w3-round">Adicionar Conta</button>
            </form>
        </div>
      </div>
</div>

<table class="w3-table-all w3-hoverable">
    <tr class="w3-theme">
        <th>ID</th>
        <th>Nome</th>
        <th>Apelido</th>
        <th>Endereço de Email</th>
        <th>Estado</th>
        <th>Permissões</th>
        <th class="w3-right-align">Opções</th>
        <th></th>
    </tr>
    @foreach ($users as $user)
        <x-preencher-tabela-users :user="$user" />
    @endforeach
</table>
</div>
</x-layout>