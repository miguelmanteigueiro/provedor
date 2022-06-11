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
                <div class="w3-third">
                    <label>
                        Estado
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
            var dataIntroduzida = e.target.value;
            var dataResposta = new Date(dataIntroduzida);

            var dataPrevistoFecho = new Date(dataResposta);
            var dataFecho = new Date(dataResposta);

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
    </script>

</x-layout>
