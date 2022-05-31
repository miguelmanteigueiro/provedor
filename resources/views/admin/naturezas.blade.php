<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row">
            <div class="w3-container w3-twothird">
                <h2>Natureza</h2>
            </div>
            <div class="w3-right-align w3-margin-top w3-container w3-third">
                <form>
                    <button formaction="/admin/analitica/naturezas/adicionar" class="w3-btn w3-green w3-round">Adicionar Natureza</button>
                </form>
            </div>
        </div>
    </div>

    <x-natureza.load-naturezas :natureza="$natureza"/>

    <div class="w3-section">
        {{ $natureza->links() }}
    </div>
</x-layout>