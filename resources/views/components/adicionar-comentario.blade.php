@props(['solicitacao'])

<div class="w3-responsive w3-section">
    <form id="editar" method="POST" action="/comentario/guardar" enctype="multipart/form-data">
        @csrf
        <!-- Enviar o ID da solicitacao no POST Request -->
        <input type="hidden" name="solicitacao_id" value="{{ $solicitacao->solicitacao_id }}">

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
                autocomplete="off" required></textarea>
        </div>

        <div class="w3-container">
            <label>
                <b>Anexar Ficheiros</b>
            </label>
            <input class="w3-input" type="file" name="ficheiros[]" id="ficheiros" autocomplete="off"
                multiple="multiple">
        </div>

        {{-- Botões --}}
        <div class="w3-bar w3-container w3-margin-top">
            <button class="w3-button w3-right w3-green w3-round w3-margin-left" type="submit">
                Submeter Comentário
            </button>

            <a href="/solicitacao/{!! $solicitacao->solicitacao_id !!}">
                <button class="w3-button w3-red w3-round" type="button">
                    Cancelar
                </button>
            </a>
        </div>
    </form>
</div>
