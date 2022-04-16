<x-layout>
    @if ($errors->any())
        <section class="w3-panel w3-red w3-round-large">
            <h3 class="">Os seguintes erros devem ser corrigidos:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <h2 class="w3-text w3-center">Nova Solicitação</h2>
    <div class="w3-responsive w3-section">
        <x-formulario-solicitacao />
        <h6 class="w3-text w3-margin-left"><i>Nota: Os campos marcados com <span style="color: red"><b>*</b></span> são
                de preenchimento obrigatório.</i></h6>
    </div>
</x-layout>

{{-- <!-- Script para preenchimento da analítica -->
<script>
function mostrarAnalitica() {
  var analitica = document.getElementById("analitica");
  var botao = document.getElementById("botaoAnalitica");
  if (analitica.style.display === "none") {
    analitica.style.display = "block";
    botaoAnalitica.innerHTML = "Esconder Analítica"
  } else {
    analitica.style.display = "none";
    botaoAnalitica.innerHTML = "Adicionar Analítica"
    var formulario = document.getElementById("analiticaSolicitacao");
    formulario.reset();
  }
}
</script> --}}
