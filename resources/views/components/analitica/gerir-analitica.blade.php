<x-layout>
    @if ($errors->any())
        <section class="w3-display-container w3-panel w3-red w3-round-large">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>

            <h3 class="">Os seguintes erros devem ser corrigidos:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <div class="w3-responsive w3-section">
        <form method="POST" action="/admin/analitica/">
            <h2 class="w3-text w3-center">Gestão de Analítica</h2>
            @csrf
            <h4 class="w3-text w3-center">Dados da Solicitação</h4>

            <!-- Enviar o ID da solicitacao no POST Request -->
            <input type="hidden" name="solicitacao_id" value="{{ $solicitacao->solicitacao_id }}">

            <div class="w3-row-padding">
                <div class="w3-half">
                    <label>
                        <b>Referência Interna</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="text"
                           name="referencia_interna"
                           id="referencia_interna"
                           value="{!! isset($solicitacao->referencia_interna) ? $solicitacao->referencia_interna : "N/A" !!}"
                           autocomplete="off"
                           disabled
                    >
                </div>

                <div class="w3-half">
                    <label>
                        <b>Funcionário</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="text"
                           name="funcionario"
                           id="funcionario"
                           value="{{ $solicitacao->user->nome }}"
                           autocomplete="off"
                           disabled
                    >
                </div>
            </div>

            <div class="w3-row-padding">
                <div class="w3-half">
                    <label>
                        <b>Nome</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="text"
                           name="estudante_nome"
                           id="estudante_nome"
                           value="{{ $solicitacao->estudante_nome }}"
                           autocomplete="off"
                           disabled
                    >
                </div>

                <div class="w3-half">
                    <label>
                        <b>Endereço de Email</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="email"
                           name="estudante_email"
                           id="estudante_email"
                           value="{{ $solicitacao->estudante_email }}"
                           autocomplete="off"
                           disabled
                    >
                </div>
            </div>

            <h4 class="w3-text w3-center">Dados Analíticos</h4>

            <div class="w3-row-padding">
                <div class="w3-quarter">
                    <label>
                        <b>Data de Inserção</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="date"
                           name="data_inicio"
                           id="data_inicio"
                           value="{{ $solicitacao->estado_solicitacao->data_inicio ?? '' }}"
                           autocomplete="off">
                </div>

                <div class="w3-quarter">
                    <label>
                        <b>Data de Resposta</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="date"
                           name="data_resposta"
                           id="data_resposta"
                           onchange="handler(event);"
                           value="{{ $solicitacao->estado_solicitacao->data_resposta ?? '' }}"
                           autocomplete="off">
                </div>

                <div class="w3-quarter">
                    <label>
                        <b>Data de Fecho Previsto</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="date"
                           name="data_fecho_previsto"
                           id="data_fecho_previsto"
                           value="{{ $solicitacao->estado_solicitacao->data_fecho_previsto ?? '' }}"
                           autocomplete="off">
                </div>

                <div class="w3-quarter">
                    <label>
                        <b>Data de Encerramento</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="date"
                           name="data_encerramento"
                           id="data_encerramento"
                           value="{{ $solicitacao->estado_solicitacao->data_encerramento ?? '' }}"
                           autocomplete="off">
                </div>
            </div>

            <div class="w3-row-padding">
                <div class="w3-quarter">
                    <label>
                        <b>Estado</b>
                    </label>
                    <select class="w3-select w3-border w3-round w3-margin-bottom"
                            name="estado"
                            id="estado"
                            value="{{ old('estado') }}"
                            autocomplete="off"
                            required>
                        @foreach ($estados as $estado)
                            @if ($solicitacao->estado_solicitacao->estado == ucwords($estado))
                                <option value="{{ $estado }}" selected>
                                    {{ ucwords($estado) }}
                                </option>
                            @else
                                <option value="{{ $estado }}" >
                                    {{ ucwords($estado) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="w3-quarter">
                    <label>
                        <b>Tipo de Solicitação</b>
                    </label>
                    <select class="w3-select w3-border w3-round w3-margin-bottom"
                            name="tipo_solicitacao"
                            id="tipo_solicitacao"
                            value="{{ old('tipo_solicitacao') }}"
                            autocomplete="off"
                            required>
                        <option value="nenhum">N/A</option>
                        <option value="aconselhamento">Aconselhamento</option>
                        <option value="orientacao">Orientação</option>
                        <option value="informacao">Informação</option>
                        <option value="mediacao">Mediação</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>


                <div class="w3-quarter">
                    <label>
                        <b>Forma de Contacto</b>
                    </label>
                    <select class="w3-select w3-border w3-round w3-margin-bottom"
                            name="forma_contacto"
                            id="forma_contacto"
                            value="{{ old('forma_contacto') }}"
                            autocomplete="off"
                            required>
                        <option value="nenhum">N/A</option>
                        <option value="email">Correio Eletrónico</option>
                        <option value="correio_postal">Correio Postal</option>
                        <option value="formulario">Formulário</option>
                        <option value="presencial">Presencial</option>
                        <option value="telefone">Telefone</option>
                        <option value="outra">Outra</option>
                    </select>
                </div>


                <div class="w3-quarter">
                    <label>
                        <b>Forma de Apresentação</b>
                    </label>
                    <select class="w3-select w3-border w3-round w3-margin-bottom"
                            name="apresentacao"
                            id="apresentacao"
                            value="{{ old('apresentacao') }}"
                            autocomplete="off"
                            required>
                        <option value="nenhum">N/A</option>
                        <option value="individual">Individual</option>
                        <option value="coletiva">Coletiva</option>
                    </select>
                </div>
            </div>

            <div class="w3-row-padding">
                <div class="w3-half">
                    <label>
                        <b>Ciclo de Estudos</b>
                    </label>
                    <select class="w3-select w3-border w3-round w3-margin-bottom"
                            name="ciclo_estudos"
                            id="ciclo_estudos"
                            value="{{ old('ciclo_estudos') }}"
                            autocomplete="off"
                            required>
                        <option value="nenhum">N/A</option>
                        <option value="1_ciclo">1º Ciclo</option>
                        <option value="2_ciclo">2º Ciclo</option>
                        <option value="mestrado_integrado">Mestrado Integrado</option>
                        <option value="3_ciclo">3º Ciclo</option>
                    </select>
                </div>

                <div class="w3-half">
                    <label>
                        <b>Curso</b>
                    </label>
                    <input class="w3-input w3-border w3-round w3-margin-bottom"
                           type="text"
                           name="curso"
                           id="curso"
                           value="{{ old('curso') ?? $solicitacao->analitica->curso }}"
                           autocomplete="off"
                    >
                </div>
            </div>

            {{-- Botões --}}
            <div class="w3-bar w3-container w3-margin-top">
                <button class="w3-button w3-right w3-green w3-round w3-margin-left" type="submit">
                    Guardar Alterações
                </button>

                <a href="/dashboard">
                    <button class="w3-button w3-red w3-round" type="button">
                        Cancelar
                    </button>
                </a>
            </div>
        </form>
    </div>

    <script>
        function handler(e){
            let dataIntroduzida = e.target.value;
            let dataResposta = new Date(dataIntroduzida);

            let dataPrevistoFecho = new Date(dataResposta);
            let dataFecho = new Date(dataResposta);

            dataPrevistoFecho.setDate(dataResposta.getDate() + 7);

            var yyyy = dataPrevistoFecho.getFullYear();
            var mm = ('0' + (dataPrevistoFecho.getMonth() + 1)).slice(-2);
            var dd = ('0' + dataPrevistoFecho.getDate()).slice(-2);
            dataPrevistoFecho = yyyy + '-' + mm + '-' + dd;
            document.getElementById('data_fecho_previsto').value = dataPrevistoFecho;

            dataFecho.setDate(dataResposta.getDate() + 14);

            yyyy = dataFecho.getFullYear();
            mm = ('0' + (dataFecho.getMonth() + 1)).slice(-2);
            dd = ('0' + dataFecho.getDate()).slice(-2);
            dataFecho = yyyy + '-' + mm + '-' + dd;
            document.getElementById('data_encerramento').value = dataFecho;
        }

        let apresentacao = '{!! isset($solicitacao->analitica->apresentacao) ? $solicitacao->analitica->getRawOriginal('apresentacao') : 'nenhum' !!}'.toLowerCase();
        let tipo_solicitacao = '{!! isset($solicitacao->analitica->tipo_solicitacao) ? $solicitacao->analitica->getRawOriginal('tipo_solicitacao') : 'nenhum' !!}'.toLowerCase();
        let forma_contacto = '{!! isset($solicitacao->analitica->forma_contacto) ? $solicitacao->analitica->getRawOriginal('forma_contacto') : 'nenhum' !!}'.toLowerCase();
        let ciclo_estudos = '{!! isset($solicitacao->analitica->ciclo_estudos) ? $solicitacao->analitica->getRawOriginal('ciclo_estudos') : 'nenhum' !!}'.toLowerCase();

        document.querySelector('#apresentacao').value = apresentacao;
        document.querySelector('#tipo_solicitacao').value = tipo_solicitacao;
        document.querySelector('#forma_contacto').value = forma_contacto;
        document.querySelector('#ciclo_estudos').value = ciclo_estudos;
    </script>
</x-layout>
