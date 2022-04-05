@props(['function'])

@if(($function === "Consultar"))
<button class="w3-button w3-green w3-round"> {!! $function !!} </button>
@endif

@if(($function === "Editar"))
<button class="w3-button w3-blue w3-round"> {!! $function !!} </button>
@endif

@if(($function === "Arquivar"))
<button class="w3-button w3-red w3-round"> {!! $function !!} </button>
@endif
