@include('common._head')

<style>
    div.card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>

<body class="dashboard w3-light-grey">
    <x-dashboard-header />
    <section class="dashboard-content">

        <div class="w3-display-middle card">
            <div class="w3-center w3-col w3-theme-l4 w3-padding w3-round">
                <p><i class="fa fa-circle-user fa-5x"></i></p>
                <p><h3>{{ Auth::user()->nome }}</h3></p>
                <p>Selecione uma opção:</p>

                <section x-data="{ letter: '' }">
                        <button @click.prevent="letter = (letter === 'b1' ? '' : 'b1')" x-show="letter === '' || letter === 'b1'" class="w3-btn w3-block w3-theme-l2 w3-round w3-section">Alterar Nome</button>
                    
                        <!-- Alterar Nome -->
                        <div x-show.transition.in="letter === 'b1'">
                            TODO

                            <form class="w3-display-middle w3-container" method="POST" action="changeName">
                                <h2 class="w3-text w3-center">Registo de Utilizador</h2>
                                @csrf
                                 
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="text" 
                                       name="nome" 
                                       id="nome" 
                                       placeholder="Nome"
                                       value="{{ old('nome')}}" 
                                       autocomplete="off" 
                                       required>
                                @error('nome')
                                       <p class="w3-text-red w3-center">{{ $message }}</p>
                                @enderror
                            
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="email" 
                                       name="email" 
                                       id="email" 
                                       placeholder="Endereço de Email" 
                                       value="{{ old('email')}}"
                                       autocomplete="off" 
                                       required>
                                @error('email')
                                    <p class="w3-text-red w3-center">{{ $message }}</p>
                                @enderror
                            
                                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                                       type="password" 
                                       name="password" 
                                       id="password" 
                                       placeholder="Palavra-passe" 
                                       autocomplete="off" 
                                       required>
                                @error('password')
                                       <p class="w3-text-red w3-center">{{ $message }}</p>
                                @enderror
                                
                                <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Registar Utilizador</button>
                             </form>
                        </div>

                        <button @click.prevent="letter = (letter === 'b2' ? '' : 'b2')" x-show="letter === '' || letter === 'b2'" class="w3-btn w3-block w3-theme-l2 w3-round w3-section">Alterar Endereço de Email</button>
                    
                        <!-- Alterar Mail -->
                        <div x-show.transition.in="letter === 'b2'">
                            TODO
                        </div>

                        <button @click.prevent="letter = (letter === 'b3' ? '' : 'b3')" x-show="letter === '' || letter === 'b3'" class="w3-btn w3-block w3-theme-l2 w3-round w3-section">Alterar Senha</button>
                    
                        <!-- Alterar Senha -->
                        <div x-show.transition.in="letter === 'b3'">
                            TODO
                        </div>
                </section>
            </div>
        </div>

    </section>

    <x-footer />
</body>