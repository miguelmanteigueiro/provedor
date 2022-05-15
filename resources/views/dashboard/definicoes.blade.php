@include('common._head')

<style>
    div.card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>

<body class="dashboard w3-light-grey">
    <x-dashboard-header />
    
    <section class="w3-container dashboard-content">

        @if (session()->has('sucesso'))
        <section x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 2500)" 
                x-show="show" 
                x-transition.duration.500ms
                class="w3-panel w3-green w3-round-large"
        >
            <h3>Sucesso!</h3>
            <p><b>{{ session('sucesso') }}</b></p>
        </section>
        @endif

        @if ($errors->any())
        <section class="w3-display-container w3-panel w3-red w3-round-large">
			<span onclick="this.parentElement.style.display='none'"
			class="w3-button w3-display-topright">&times;</span>
            
			<h3 class="">Os seguintes erros devem ser corrigidos:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </section>
        @endif

        @if (session()->has('erro'))
        <section class="w3-display-container w3-panel w3-red w3-round-large">
			<span onclick="this.parentElement.style.display='none'"
			class="w3-button w3-display-topright">&times;</span>
            
			<h3 class="">Ocorreu um erro:</h3>
            <ul>
                <li>{{ session('erro') }}</li>
            </ul>
        </section>
        @endif
        
        <div class="w3-display-middle card">
            <div class="w3-center w3-col w3-theme-l4 w3-padding w3-round">
                <p><i class="fa fa-circle-user fa-5x"></i></p>
                <p><h3>{{ Auth::user()->nome }}</h3></p>
                <p>Selecione uma opção:</p>
                
                <section x-data="{ letter: '' }"> 
                        <button @click.prevent="letter = (letter === 'b1' ? '' : 'b1')" x-show="letter === '' || letter === 'b1'" class="w3-btn w3-block w3-theme-l1 w3-round w3-section">Alterar Nome</button>
                        
                        <!-- Alterar Nome -->
                        <div x-show.transition.in="letter === 'b1'">
                            <hr>
                            <form class="" method="POST" action="definicoes/changeName">
                                @csrf
                                 
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="text" 
                                       name="primeiro_nome" 
                                       id="primeiro_nome" 
                                       placeholder="Nome"
                                       autocomplete="off" 
                                       required>

                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="text" 
                                       name="ultimo_nome" 
                                       id="ultimo_nome" 
                                       placeholder="Apelido"
                                       autocomplete="off" 
                                       required>
                                
                                <button class="w3-btn w3-block w3-green w3-round w3-section" type="submit">Confirmar Alteração</button>
                                <button @click.prevent="letter = (letter === 'b1' ? '' : 'b1')" x-show="letter === '' || letter === 'b1'" class="w3-btn w3-block w3-red w3-round w3-section" type="button">Fechar</button>
                             </form>
                        </div>

                        <button @click.prevent="letter = (letter === 'b2' ? '' : 'b2')" x-show="letter === '' || letter === 'b2'" class="w3-btn w3-block w3-theme-l1 w3-round w3-section">Alterar Endereço de Email</button>
                    
                        <!-- Alterar Mail -->
                        <div x-show.transition.in="letter === 'b2'">
                            <hr>
                            <form class="" method="POST" action="definicoes/changeEmail">
                                @csrf
                                 
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="email" 
                                       name="email" 
                                       id="email" 
                                       placeholder="Novo endereço de email"
                                       autocomplete="off" 
                                       required>

                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="email" 
                                       name="email_confirmation" 
                                       id="email_confirmation" 
                                       placeholder="Confirme o endereço"
                                       autocomplete="off" 
                                       required>
                                
                                <button class="w3-btn w3-block w3-green w3-round w3-section" type="submit">Confirmar Alteração</button>
                                <button @click.prevent="letter = (letter === 'b2' ? '' : 'b2')" x-show="letter === '' || letter === 'b2'" class="w3-btn w3-block w3-red w3-round w3-section" type="button">Fechar</button>
                             </form>
                        </div>

                        <button @click.prevent="letter = (letter === 'b3' ? '' : 'b3')" x-show="letter === '' || letter === 'b3'" class="w3-btn w3-block w3-theme-l1 w3-round w3-section">Alterar Senha</button>
                    
                        <!-- Alterar Senha -->
                        <div x-show.transition.in="letter === 'b3'">
                            <hr>
                            <form class="" method="POST" action="definicoes/changePassword">
                                @csrf
                                 
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="password" 
                                       name="password" 
                                       id="password" 
                                       placeholder="Nova password"
                                       autocomplete="off" 
                                       required>

                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       placeholder="Confirme a password"
                                       autocomplete="off" 
                                       required>
                                
                                <button class="w3-btn w3-block w3-green w3-round w3-section" type="submit">Confirmar Alteração</button>
                                <button @click.prevent="letter = (letter === 'b3' ? '' : 'b3')" x-show="letter === '' || letter === 'b3'" class="w3-btn w3-block w3-red w3-round w3-section" type="button">Fechar</button>
                             </form>
                        </div>
                </section>
            </div>
        </div>

    </section>

    <x-footer />
</body>