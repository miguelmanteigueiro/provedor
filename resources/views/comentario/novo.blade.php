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

    <h2 class="w3-text w3-center">Adicionar Comentário</h2>
    <div class="w3-responsive w3-section">
        <x-adicionar-comentario :solicitacao="$solicitacao"/>
        <h6 class="w3-text w3-margin-left"><i>Nota: Os campos marcados com <span style="color: red"><b>*</b></span> são
                de preenchimento obrigatório.</i></h6>
    </div>
</x-layout>
