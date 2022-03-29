@include('common._head')

<body class="w3-theme">
    <form class="w3-display-middle w3-container" method="POST" action="/admin/register/">
        <h2 class="w3-text w3-center">Registo de Utilizador</h2>
        @csrf
        
        <input class="w3-input w3-border w3-round" 
               type="text" 
               name="nome" 
               id="nome" 
               placeholder="Nome" 
               autocomplete="off" 
               required>
        <br>
        <input class="w3-input w3-border w3-round" 
               type="email" 
               name="email" 
               id="email" 
               placeholder="Endereço de Email" 
               autocomplete="off" 
               required>
        <br>
        <input class="w3-input w3-border w3-round" 
               type="password" 
               name="senha" 
               id="senha" 
               placeholder="Palavra-passe" 
               autocomplete="off" 
               required>
        
        <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Registar Utilizador</button>
    </form>
</body>