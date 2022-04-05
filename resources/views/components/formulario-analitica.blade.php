<div id="analitica" style="display: none">
    <h2 class="w3-text w3-center">Preenchimento da Analítica</h2>
    <form id="analiticaSolicitacao">
        <div class="w3-row-padding">
            <div class="w3-third">
                <label>
                    <b>Referência Interna</b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="text" 
                    name="referencia" 
                    id="referencia" 
                    value="{{ old('referencia')}}" 
                    autocomplete="off" 
                >
                @error('referencia')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="w3-third">
                <label>
                    <b>Funcionário <span style="color:red">*</span></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="text" 
                    name="funcionario" 
                    id="funcionario" 
                    autocomplete="off" 
                    disabled
                >
                @error('funcionario')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="w3-third">
                <label>
                    <b>Data de Inserção <span style="color:red">*</span></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="date" 
                    name="date" 
                    id="date" 
                    value="{{ old('date')}}" 
                    autocomplete="off" 
                    required
                >
                @error('date')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
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
                    name="nome" 
                    id="nome" 
                    placeholder="Fernando Pessoa"
                    value="{{ old('nome')}}" 
                    autocomplete="off" 
                    required
                >
                @error('nome')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="w3-half">
                <label>
                    <b>Endereço de Email <span style="color:red">*</span></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="email" 
                    name="email" 
                    id="email" 
                    placeholder="fernando.pessoa@email.com"
                    value="{{ old('email')}}" 
                    autocomplete="off" 
                    required
                >
                @error('email')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w3-row-padding">
            <div class="w3-third">
                <label>
                    <b>Contacto Telefónico</b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="number" 
                    name="telefone" 
                    id="telefone" 
                    value="{{ old('telefone')}}" 
                    autocomplete="off" 
                >
                @error('nome')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="w3-third">
                <label>
                    <b>Situação Académica <span style="color:red">*</span></b>
                </label>
                <select class="w3-select w3-border w3-round w3-margin-bottom" 
                        name="situacaoAcad" 
                        id="situacaoAcad" 
                        value="{{ old('situacaoAcad')}}" 
                        autocomplete="off" 
                        required>
                    <option value="nenhum">Não se aplica</option>
                    <option value="estudante">Estudante</option>
                    <option value="oldEstudante">Ex-Estudante</option>
                    <option value="candidato">Candidato</option>
                    <option value="outro">Outro</option>
                </select>
                @error('situacaoAcad')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="w3-third">
                <label>
                    <b>Número TODO COM BASE NA SIT ACAD<!-- <span style="color:red">*</span> --></b>
                </label>
                <input class="w3-input w3-border w3-round w3-margin-bottom" 
                    type="number" 
                    name="numEstudante" 
                    id="numEstudante" 
                    placeholder="12345"
                    value="{{ old('numEstudante')}}" 
                    autocomplete="off" 
                >
                @error('numEstudante')
                    <p class="w3-text-red w3-center">{{ $message }}</p>
                @enderror
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
                value="{{ old('nome')}}" 
                autocomplete="off" 
                required
            ></textarea>
            @error('nome')
                <p class="w3-text-red w3-center">{{ $message }}</p>
            @enderror
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
            @error('ficheiros')
                <p class="w3-text-red w3-center">{{ $message }}</p>
            @enderror
        </div>
    </form>
</div>