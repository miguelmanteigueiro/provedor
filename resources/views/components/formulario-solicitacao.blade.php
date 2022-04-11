<form id="novoPedido" method="POST" action="/solicitacao/guardar">
    @csrf
    <div class="w3-row-padding">
        <div class="w3-third">
            <label>
                <b>Referência Interna</b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="text" 
                name="referencia_interna" 
                id="referencia_interna" 
                value="{{ old('referencia_interna') }}" 
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
                value="{{ Auth::user()->nome }}" 
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
                value="{{ old('data_inicio')}}" 
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
                placeholder="Fernando Pessoa"
                value="{{ old('estudante_nome')}}" 
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
                placeholder="fernando.pessoa@email.com"
                value="{{ old('estudante_email')}}" 
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
                type="number" 
                name="estudante_telefone" 
                id="estudante_telefone" 
                value="{{ old('estudante_telefone')}}" 
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
                    value="{{ old('situacao_academica')}}" 
                    autocomplete="off" 
                    required>
                <option value="nenhum">Não se aplica</option>
                <option value="estudante">Estudante</option>
                <option value="oldEstudante">Ex-Estudante</option>
                <option value="candidato">Candidato</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div class="w3-third">
            <label>
                <b>Número <!-- <span style="color:red">*</span> --></b>
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" 
                type="number" 
                name="estudante_id" 
                id="estudante_id" 
                placeholder="12345"
                value="{{ old('estudante_id')}}" 
                autocomplete="off" 
            >
        </div>
    </div>

    <div class="w3-row w3-container">
        <label>
            <b>Descrição da Ocorrência <span style="color:red">*</span></b>
        </label>
        <textarea class="w3-input w3-border w3-round w3-margin-bottom"
            rows="10" 
            name="descricao" 
            id="descricao" 
            autocomplete="off" 
            required
        >{{ old('descricao')}}</textarea>
    </div>

    <div class="w3-container">
        <label>
            <b>Anexar Ficheiros</b>
        </label>
        <input class="w3-input" 
            type="file" 
            name="ficheiros" 
            id="ficheiros" 
            autocomplete="off" 
            multiple
        >
    </div>

    {{-- Botões --}}
    <div class="w3-bar w3-container w3-margin-top">
        <button class="w3-button w3-right w3-green w3-round w3-margin-left" type="submit">
            Registar
        </button>

        <a href="/dashboard">
            <button class="w3-button w3-red w3-round" type="button">
                Cancelar
            </button>
        </a>
    </div>
</form>