@include('common._head')

@include('login._header')

<body class="w3-theme">
    <form class="w3-display-middle w3-container" method="POST" action="/login">
        <h2 class="w3-text w3-center">Autenticação</h2>
        @csrf
        
        <input class="w3-input w3-border w3-round" type="email" name="email" id="email" placeholder="utilizador@ubi.pt" autocomplete="off" required>
        <br>
        <input class="w3-input w3-border w3-round" type="password" name="password" id="password" placeholder="Palavra-passe" autocomplete="off" required>
        
        <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Autenticar-se</button>
    </form>
</body>

@include('login._footer')