<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row-padding">
            <h2>Gráficos</h2>
        </div>

        <div class="w3-row-padding">
            <h4>Escolha a natureza para qual deseja gerar as estatísticas.</h4>

        </div>

        <div class="w3-row-padding">
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
                    <button id="submit" class="w3-button w3-green w3-round w3-margin-top" type="submit">
                        Obter Gráfico
                    </button>
            </form>
        </div>

        <div class="w3-row-padding">
            <h6>Apenas são apresentadas as naturezas para as quais existem assuntos guardados.</h6>
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
