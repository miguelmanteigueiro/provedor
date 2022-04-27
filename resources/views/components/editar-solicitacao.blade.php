@props(['solicitacao', 'anexos', 'estado'])

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
                value="{{ $solicitacao->referencia_interna }}" 
                autocomplete="off" 
            >
        </div>

        <div class="w3-third">
            <label>
                <b>Funcionário <span style="color:red">*</span></b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="text" 
                name="utilizador_id" 
                id="utilizador_id" 
                autocomplete="off" 
                value="{{ $solicitacao->user->nome }}" 
                disabled
            >
        </div>

        <div class="w3-third">
            <label>
                <b>Data de Inserção <span style="color:red">*</span></b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="date" 
                name="data_inicio" 
                id="data_inicio" 
                value="{{ $estado->data_inicio ?? '' }}"
                autocomplete="off" 
                required
            >
        </div>
    </div>

    <h4 class="w3-text w3-center">Dados Pessoais</h4>

    <div class="w3-row-padding">
        <div class="w3-half">
            <label>
                <b>Nome <span style="color:red">*</span></b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="text" 
                name="estudante_nome" 
                id="estudante_nome" 
                value="{{ $solicitacao->estudante_nome }}" 
                autocomplete="off" 
                required
            >
        </div>

        <div class="w3-half">
            <label>
                <b>Endereço de Email <span style="color:red">*</span></b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="email" 
                name="estudante_email" 
                id="estudante_email" 
                value="{{ $solicitacao->estudante_email }}" 
                autocomplete="off" 
                required
            >
        </div>
    </div>

    <div class="w3-row-padding">
        <div class="w3-third">
            <label>
                <b>Contacto Telefónico</b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="text" 
                name="estudante_telefone" 
                id="estudante_telefone" 
                value="{{ $solicitacao->estudante_telefone }}" 
                autocomplete="off" 
            >
        </div>

        <div class="w3-third">
            <label>
                <b>Situação Académica <span style="color:red">*</span></b>
            </label>
            <select class="w3-select w3-border w3-round w3-margin-bottom" 
                    name="situacao_academica" 
                    id="situacao_academica" 
                    value="{{ $solicitacao->situacao_academica }}" 
                    autocomplete="off" 
                    required>
                <option value="nenhum">Não se aplica</option>
                <option value="estudante">Estudante</option>
                <option value="ex_estudante">Ex-Estudante</option>
                <option value="candidato">Candidato</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div class="w3-third">
            <label>
                <b>Número de Estudante</b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="number" 
                name="estudante_id" 
                id="estudante_id" 
                value="{{ $solicitacao->estudante_id }}" 
                autocomplete="off" 
            >
        </div>
    </div>

    <div class="w3-row w3-container">
        <label>
            <b>Descrição da Ocorrência <span style="color:red">*</span></b>
        </label>
        <textarea class="w3-input w3-border w3-round w3-margin-bottom"
            rows="15" 
            name="descricao" 
            id="descricao" 
            autocomplete="off" 
            required
        >{!! ($solicitacao->descricao) !!}</textarea>
    </div>

    <div class="w3-container">
        <label>
            <b>Anexar Novos Ficheiros</b>
        </label>
        <input class="w3-input" 
            type="file" 
            name="ficheiros[]" 
            id="ficheiros" 
            autocomplete="off" 
            multiple="multiple"
        >
    </div>

    <div class="w3-container w3-margin-top">
        @if($anexos->isNotEmpty())
            <label>
                <b>Ficheiros Anexados (click para <i>download</i>)</b>
            </label>
            @foreach ($anexos as $anexo)
                @php
                    $path = "anexos/" . $solicitacao->solicitacao_id . "/";
                    $filename = str_replace($path, "", $anexo->path);
                @endphp
                <br>
                <a href={{ asset("storage/" . $anexo->path) }} download>
                    <b>{!! $filename !!}</b>
                </a>
            @endforeach
        @else
            <label>
                <b>Ficheiros Anexados</b>
            </label>
            <p>Não foram anexados ficheiros.</p>
        @endif
    </div>

    <div class="w3-margin-top w3-row w3-container">
        <h4 class="w3-text w3-center">Motivo da Edição <span style="color:red">*</span></h4>
        <input class="w3-input w3-border w3-round w3-margin-bottom" 
            type="text" 
            name="motivo_edicao" 
            id="motivo_edicao" 
            placeholder="Breve descrição com o motivo da edição"
            value="{{ old('motivo_edicao') }}" 
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
