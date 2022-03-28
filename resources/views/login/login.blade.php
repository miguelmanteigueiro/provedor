@include('common._head')

@include('login._header')

<body class="w3-theme">
    <form class="w3-display-middle w3-container" method="POST" action="{{ url('/main/checklogin') }}">
        <h2 class="w3-text w3-center">Autenticação</h2>
        {{ csrf_field() }}
        
        <input class="w3-input w3-border w3-round" input type="email" name="email" placeholder="utilizador@ubi.pt" autocomplete="off">
        <br>
        <input class="w3-input w3-border w3-round" type="password" name="password" placeholder="Palavra-passe" autocomplete="off">
        
        <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit" name="login">Autenticar-se</button>
    </form>
</body>

@include('login._footer')