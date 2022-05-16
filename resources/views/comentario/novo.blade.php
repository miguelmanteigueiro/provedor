<x-layout>

<form id="editar" method="POST" action="/solicitacao/editar/" enctype="multipart/form-data">
    @csrf
    <!-- Enviar o ID da solicitacao no POST Request -->
    <input type="hidden" name="solicitacao_id" value="{{ $solicitacao->solicitacao_id }}">

    <div class="w3-row-padding">
        <div class="w3-third">
            <label>
                <b>Referência Interna</b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="text" 
                name="referencia_interna" 
                id="referencia_interna" 
                value="{{ old('referencia_interna') ?? $solicitacao->referencia_interna }}" 
                autocomplete="off" 
            >
        </div>

    {{-- Botões --}}
    <div class="w3-bar w3-container w3-margin-top">
        <button class="w3-button w3-right w3-green w3-round w3-margin-left" type="submit">
            Submeter Edição
        </button>

        <a href="/dashboard">
            <button class="w3-button w3-red w3-round" type="button">
                Cancelar
            </button>
        </a>
    </div>
</form>

</x-layout>