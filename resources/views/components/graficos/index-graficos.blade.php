<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row-padding">
            <h2>Gráficos</h2>
        </div>

        <div class="w3-row-padding">
            <h4>Escolha a natureza para qual deseja gerar as estatísticas.</h4>

        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obter" method="POST" action="/graficos/obter">
                @csrf
                @foreach($naturezas as $natureza)
                    @if($natureza->assunto->count())
                        <input type="checkbox" name="{{$natureza->getRawOriginal('descricao')}}" id="{{$natureza->getRawOriginal('descricao')}}" onclick="clicked(this)">
                        <label for="{{$natureza->descricao}}">
                            {{$natureza->descricao}}
                        </label>
                        <br>
                    @endif
                @endforeach
                <div class="w3-margin-top">
                    <button id="submit" class="w3-button w3-green w3-round" type="submit">
                        Obter Gráfico
                    </button>
                    <label for="data_inicio">Data de início:</label>
                    <input type="date" id="data_inicio" name="data_inicio">

                    <label for="data_fim">Data de fim:</label>
                    <input type="date" id="data_fim" name="data_fim">
                </div>
            </form>
        </div>

        <div class="w3-row-padding">
            <h6><i>Nota: Apenas são apresentadas as naturezas para as quais existem assuntos guardados.</i></h6>
        </div>

        <div class="w3-row-padding">
            <h3>Outras estatísticas:</h3>
        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obterFollowUp" method="POST" action="/graficos/obter/followup">
                @csrf
                <button id="submit" class="w3-button w3-green w3-round" type="submit">
                    Obter Gráfico de <i>Follow-up</i>
                </button>

                <label for="data_inicio">Data de início:</label>
                <input type="date" id="data_inicio" name="data_inicio">

                <label for="data_fim">Data de fim:</label>
                <input type="date" id="data_fim" name="data_fim">
            </form>
        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obterSituacaoTipologia" method="POST" action="/graficos/obter/situacaoTipologia">
                @csrf
                <button id="submit" class="w3-button w3-green w3-round" type="submit">
                    Obter Gráfico de Natureza/Tipologia
                </button>

                <label for="data_inicio">Data de início:</label>
                <input type="date" id="data_inicio" name="data_inicio">

                <label for="data_fim">Data de fim:</label>
                <input type="date" id="data_fim" name="data_fim">
            </form>
        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obterSituacaoCicloEstudos" method="POST" action="/graficos/obter/situacaoCicloEstudos">
                @csrf
                <button id="submit" class="w3-button w3-green w3-round" type="submit">
                    Obter Gráfico de Natureza/Ciclo de Estudos
                </button>

                <label for="data_inicio">Data de início:</label>
                <input type="date" id="data_inicio" name="data_inicio">

                <label for="data_fim">Data de fim:</label>
                <input type="date" id="data_fim" name="data_fim">
            </form>
        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obterSituacaoGenero" method="POST" action="/graficos/obter/situacaoGenero">
                @csrf
                <button id="submit" class="w3-button w3-green w3-round" type="submit">
                    Obter Gráfico de Natureza/Género
                </button>

                <label for="data_inicio">Data de início:</label>
                <input type="date" id="data_inicio" name="data_inicio">

                <label for="data_fim">Data de fim:</label>
                <input type="date" id="data_fim" name="data_fim">
            </form>
        </div>

        <div class="w3-row-padding w3-margin-top">
            <form id="obterSituacaoFaculdade" method="POST" action="/graficos/obter/situacaoFaculdade">
                @csrf
                <button id="submit" class="w3-button w3-green w3-round" type="submit">
                    Obter Gráfico de Natureza/Faculdade
                </button>

                <label for="data_inicio">Data de início:</label>
                <input type="date" id="data_inicio" name="data_inicio">

                <label for="data_fim">Data de fim:</label>
                <input type="date" id="data_fim" name="data_fim">
            </form>
        </div>
    </div>

    <script>
        function clicked(checkbox) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            console.log(checkboxes);
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }
    </script>
</x-layout>
