<header class="w3-bar w3-theme">
    <a href="/dashboard" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-home"></i> Início</a>
    <a href="/novo" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-file-alt"></i> Nova Solicitação</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile">Link 3</a>

    <div class="w3-dropdown-hover w3-right">
        <button class="w3-button">
            <i class="fa fa-user-circle"></i> 
            {{ explode(' ', Auth::user()->nome)[0] }}
        </button>
        <div class="w3-dropdown-content w3-bar-block w3-border"  style="right:0">
            <a href="/definicoes" class="w3-bar-item w3-button">
                <i class="fa fa-gears"></i> 
                Definições
            </a>
            <a href="/logout" class="w3-bar-item w3-button">
                <i class="fa fa-sign-out"></i> 
                Logout
            </a>
          </div>
      </div>

    {{-- <a href="/definicoes" class="w3-bar-item w3-button w3-right w3-mobile">
        <i class="fa fa-user-circle"></i> 
        {{ explode(' ', Auth::user()->nome)[0] }}
    </a> --}}
</header>