<x-layout>
    @if ($errors->any())
        <section class="w3-display-container w3-panel w3-red w3-round-large">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>

            <h3 class="">Os seguintes erros devem ser corrigidos:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </section>
    @endif
    <div class="w3-container">

        <form method="POST" action="/admin/contas/editar" style="width:50%;margin:auto;">
            <h2 class="w3-text w3-center">Editar Utilizador</h2>
            @csrf

            <!-- Enviar o ID do utilizador no POST Request -->
            <input type="hidden" name="id" value="{{ $user->id }}">

            <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="primeiro_nome"
                id="primeiro_nome" placeholder="Nome" value="{{ $user->primeiro_nome }}" autocomplete="off" required>

            <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="ultimo_nome" id="ultimo_nome"
                placeholder="Apelido" value="{{ $user->ultimo_nome }}" autocomplete="off" required>

            <input class="w3-input w3-border w3-round w3-margin-bottom" type="email" name="email" id="email"
                placeholder="Endereço de Email" value="{{ $user->email }}" autocomplete="off" required>

            <input class="w3-input w3-border w3-round w3-margin-bottom" type="email" name="email_confirmation"
                id="email_confirmation" placeholder="Confirme o Email" value="{{ $user->email }}" autocomplete="off"
                required>

            <input type="checkbox" name="resetPassword" value="true">
            <label for="resetPassword">Repor password?</label>

            @if ($user->administrador == 1)
                <br><input type="checkbox" name="administrador"checked>
            @else
                <br><input type="checkbox" name="administrador">
            @endif
            <label for="resetPassword">Permissões de administração</label>

            <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Confirmar Alteração</button>
        </form>

</x-layout>
