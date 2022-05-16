@props(['comentario'])

<div class="w3-card-4 w3-grey w3-padding">
    <p><b>{{ $comentario->utilizador->nome }}</b> escreveu no dia
        <b>{{ $comentario->data_comentario }}</b> o seguinte comentário:
    </p>
    <textarea class="w3-input w3-border w3-round w3-margin-bottom" rows="5" name="descricao" id="descricao"
        autocomplete="off" disabled style="resize='none'">{!! $comentario->comentario !!}
    </textarea>

    {{-- <div class="w3-container">
        @if ($anexos->isNotEmpty())
            <label>
                <b>Ficheiros Anexados (click para <i>download</i>)</b>
            </label>
            @foreach ($anexos as $anexo)
                @php
                    $path = 'anexos/' . $solicitacao->solicitacao_id . '/';
                    $filename = str_replace($path, '', $anexo->path);
                @endphp
                <br>
                <a href="{{ asset('storage/' . $anexo->path) }}" download>
                    <b>{!! $filename !!}</b>
                </a>
            @endforeach
        @else
            <label>
                <b>Ficheiros Anexados</b>
            </label>
            <p>Não foram anexados ficheiros.</p>
        @endif
    </div> --}}
</div>
<br>

