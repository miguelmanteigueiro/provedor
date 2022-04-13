@props(['function', 'id'])


@if(($function === "Consultar"))
<form>
    <button formaction="/solicitacao/{{ $id }}" class="w3-button w3-green w3-round"> {!! $function !!} </button>
</form>
@endif

@if(($function === "Editar"))
<form>
    <button formaction="/solicitacao/editar/{{ $id }}" class="w3-button w3-blue w3-round"> {!! $function !!} </button>
</form>
@endif

@if(($function === "Arquivar"))
<form>
    <button formaction="/" class="w3-button w3-red w3-round"> {!! $function !!} </button>
</form>
@endif
