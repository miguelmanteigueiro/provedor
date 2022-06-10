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
    <div class="w3-container">

        <form method="POST" action="/admin/analitica/" style="width:50%;margin:auto;">
            <h2 class="w3-text w3-center">Gestão de Analítica</h2>
            @csrf

{{--            <label>--}}
{{--                Natureza--}}
{{--            </label>--}}
{{--            <select class="w3-select w3-border w3-round w3-margin-bottom"--}}
{{--                    name="natureza"--}}
{{--                    id="natureza"--}}
{{--                    value="{{ old('natureza') }}"--}}
{{--                    autocomplete="off"--}}
{{--                    required>--}}
{{--                @foreach ($natureza as $natureza)--}}
{{--                    <option value="{{ $natureza->natureza_id }}" >--}}
{{--                        {{ $natureza->descricao }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}

{{--            <label>--}}
{{--                Subcategoria--}}
{{--            </label>--}}
{{--            <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="subcategoria"--}}
{{--                   id="subcategoria" value="{{ old('subcategoria') }}" autocomplete="off" required>--}}

{{--            <label>--}}
{{--                Descrição do Assunto--}}
{{--            </label>--}}
{{--            <textarea class="w3-input w3-border w3-round w3-margin-bottom"--}}
{{--                      rows="3"--}}
{{--                      name="descricao"--}}
{{--                      id="descricao"--}}
{{--                      autocomplete="off"--}}
{{--                      required--}}
{{--            >{{ old('descricao')}}</textarea>--}}

{{--            <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Adicionar</button>--}}
        </form>

    </div>
</x-layout>
