<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row">
            <div class="w3-container w3-twothird">
                <h2>Assuntos</h2>
            </div>
            <div class="w3-right-align w3-margin-top w3-container w3-third">
                <form>
                    <button formaction="/analitica/assuntos/adicionar" class="w3-btn w3-green w3-round">Adicionar Assunto</button>
                </form>
            </div>
        </div>
    </div>

    <x-assunto.load-assuntos :assunto="$assunto"/>

    <div class="w3-section">
        {{ $assunto->links() }}
    </div>
</x-layout>
