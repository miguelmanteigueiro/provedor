@props(['naturezas', 'assuntos', 'solicitacao'])

@if($assuntos->count())
    <div class="w3-row-padding">
        <div class="w3-rest">
            @foreach($naturezas as $natureza)
                @if($natureza->assunto->count())
                <fieldset>
                    <legend><b>{!! $natureza->descricao !!}</b></legend>

                    @foreach($natureza->assunto as $assunto)
                    <div>
                        <input type="checkbox"
                               id="{{$assunto->assunto_id}}"
                               name="{{$assunto->assunto_id}}"
                               @if($solicitacao->analitica)
                                    {{ ($solicitacao->analitica->assunto_analitica->contains('assunto_id', $assunto->assunto_id)) ? 'checked' : '' }}
                               @endif
                        >
                        <label for="{{$assunto->assunto_id}}">
                            {!! $assunto->subcategoria !!}
                        </label>
                    </div>
                    @endforeach

                </fieldset>

                @endif
            @endforeach
        </div>
    </div>
@else
    <h2 class="w3-text w3-center">Ainda não foram criadas naturezas ou respetivos assuntos.</h2>
@endif
