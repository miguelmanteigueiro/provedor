<x-layout>
        <h2 class="w3-text w3-center">Consultar Solicitação</h2>
        <div class="w3-responsive w3-section">
            <form id="consultar">
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
                            value="{{ $solicitacao->referencia_interna }}" 
                            autocomplete="off" 
                            disabled
                        >
                    </div>
            
                    <div class="w3-third">
                        <label>
                            <b>Funcionário</b>
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
                            <b>Data de Inserção</b>
                        </label>
                        <input class="w3-input w3-border w3-round w3-margin-bottom" 
                            type="date" 
                            name="data_inicio" 
                            id="data_inicio" 
                            value="{{ $estado->data_inicio ?? '' }}"
                            autocomplete="off" 
                            disabled
                        >
                    </div>
                </div>
            
                <h4 class="w3-text w3-center">Dados Pessoais</h4>
            
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
                            disabled 
                        >
                    </div>
            
                    <div class="w3-third">
                        <label>
                            <b>Situação Académica</b>
                        </label>
                        <input class="w3-select w3-border w3-round w3-margin-bottom" 
                                name="situacao_academica" 
                                id="situacao_academica" 
                                value=" {{ $solicitacao->situacao_academica }}"
                                autocomplete="off" 
                                disabled>
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
                            disabled
                        >
                    </div>
                </div>
            
                <div class="w3-row w3-container">
                    <label>
                        <b>Descrição da Ocorrência</b>
                    </label>
                    <textarea class="w3-input w3-border w3-round w3-margin-bottom"
                        rows="15" 
                        name="descricao" 
                        id="descricao" 
                        autocomplete="off" 
                        disabled
                    >{!! ($solicitacao->descricao) !!}</textarea>
                </div>
            
                <div class="w3-container">
                    @if($anexos->isNotEmpty())
                        <label>
                            <b>Ficheiros Anexados (click para <i>download</i>)</b>
                        </label>
                        @foreach ($anexos as $anexo)
                            @php
                                $path = "anexos/" . $solicitacao->solicitacao_id . "/";
                                $filename = str_replace($path, "", $anexo->path);
                            @endphp
                            <p></p>
                            {{-- <a href={{route('download', $anexo->path)}}>
                                <b>{!! $filename !!}</b>
                            </a> --}}
                            @php
                            #dd($anexo->path);
                            @endphp
                            <a href={{ asset("storage/" . $anexo->path) }}>
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
            </form>
        </div>
</x-layout>
