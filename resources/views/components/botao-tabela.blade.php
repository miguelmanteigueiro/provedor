@props(['function', 'id'])


@if(($function === "Consultar"))
<form>
    <button formaction="/solicitacao/{{ $id }}" class="w3-btn w3-green w3-round"> {!! $function !!} </button>
</form>
@endif

@if(($function === "Editar"))
<form>
    <button formaction="/solicitacao/editar/{{ $id }}" class="w3-btn w3-blue w3-round"> {!! $function !!} </button>
</form>
@endif

@if(($function === "Arquivar"))
<form>
    <button formaction="/solicitacao/arquivar/{{ $id }}" class="w3-btn w3-red w3-round"> {!! $function !!} </button>
</form>
@endif

@if(($function === "Desarquivar"))
<form>
    <button formaction="/solicitacao/desarquivar/{{ $id }}" class="w3-btn w3-red w3-round"> {!! $function !!} </button>
</form>
@endif
