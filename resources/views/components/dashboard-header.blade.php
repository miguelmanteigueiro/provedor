<header class="w3-bar w3-theme">
    <a href="/dashboard" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-home"></i> Início</a>
    <a href="/solicitacao/novo" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-file-alt"></i> Registar Solicitação</a>
    <a href="/analitica" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-magnifying-glass"></i> Analítica</a>
    <a href="/graficos" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-chart-line"></i> Estatísticas</a>

    <div class="w3-dropdown-hover w3-right">
        <button class="w3-button">
            <i class="fa fa-user-circle"></i>
            {{ Auth::user()->primeiro_nome }}
        </button>
        <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
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
    @if (Auth::user()->administrador == 1)
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button">
                <i class="fa fa-screwdriver-wrench"></i> Administração
            </button>
            <div class="w3-dropdown-content w3-bar-block w3-border">
                <a href="/admin/contas" class="w3-bar-item w3-button">
                    <i class="fa fa-users"></i>
                    Contas
                </a>
                <a href="/admin/logs" class="w3-bar-item w3-button">
                    <i class="fa fa-file-shield"></i>
                    <i>Logs</i>
                </a>
                <a href="/admin/backups" class="w3-bar-item w3-button">
                    <i class="fa fa-database"></i>
                    <i>Backups</i>
                </a>
            </div>
        </div>
    @endif
    <a href="/arquivo" class="w3-bar-item w3-button w3-mobile w3-right"><i class="fa fa-archive"></i> Arquivo</a>
</header>
