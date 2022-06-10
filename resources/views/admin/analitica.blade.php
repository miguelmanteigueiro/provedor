<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row">
            <div class="w3-container w3-twothird">
                <h2>Analítica</h2>
            </div>
            <div class="w3-right-align w3-margin-top w3-container w3-third">
                <div class="w3-half">
                    <form>
                        <button formaction="/admin/analitica/assuntos" class="w3-btn w3-green w3-round">Gerir Assuntos</button>
                    </form>
                </div>
                <div class="w3-half">
                    <form>
                        <button formaction="/admin/analitica/naturezas" class="w3-btn w3-green w3-round">Gerir Naturezas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-analitica.load-analitica :solicitacoes="$solicitacoes"/>

    <div class="w3-section">
        {{ $solicitacoes->links() }}
    </div>
</x-layout>
