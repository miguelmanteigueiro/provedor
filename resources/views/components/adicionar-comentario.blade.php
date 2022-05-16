@props(['solicitacao'])

<div class="w3-responsive w3-section">
    <form id="editar" method="POST" action="/comentario/guardar" enctype="multipart/form-data">
        @csrf
        <!-- Enviar o ID da solicitacao e a data no POST Request -->
        <input type="hidden" name="solicitacao_id" value="{{ $solicitacao->solicitacao_id }}">
        <input type="hidden" name="data_comentario" value="{{ date('Y-m-d H:i:s') }}">

        <div class="w3-row-padding">
            <div class="w3-half">
                <label>
                    <b>ID da Solicitação <span style="color:red">*</span></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="solicitacao_id"
                    id="solicitacao_id" value="{{ $solicitacao->solicitacao_id }}" autocomplete="off" disabled>
            </div>

            <div class="w3-half">
                <label>
                    <b>Funcionário <span style="color:red">*</span></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="solicitacao_id"
                    id="solicitacao_id" value="{{ Auth::user()->nome }}" autocomplete="off" disabled>
            </div>
        </div>

        <div class="w3-row w3-container">
            <label>
                <b>Comentário <span style="color:red">*</span></b>
            </label>
            <textarea class="w3-input w3-border w3-round w3-margin-bottom" rows="15" name="comentario" id="comentario"
                autocomplete="off"></textarea>
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
</div>
