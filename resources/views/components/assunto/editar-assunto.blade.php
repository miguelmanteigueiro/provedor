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

        <form method="POST" action="/admin/analitica/assuntos/editar" style="width:50%;margin:auto;">
            <h2 class="w3-text w3-center">Editar Assunto</h2>
            @csrf

            <!-- Enviar o ID do assunto no POST Request -->
            <input type="hidden" name="assunto_id" value="{{ $assunto->assunto_id }}">

            <label>
                Natureza
            </label>
            <select class="w3-select w3-border w3-round w3-margin-bottom" 
            name="natureza_id" 
            id="natureza_id" 
            value="{{ old('natureza_id') }}" 
            autocomplete="off" 
            required>
                @foreach ($natureza as $natureza)
                    @if ($assunto->natureza->descricao == $natureza->descricao)
                        <option value="{{ $natureza->natureza_id }}" selected> 
                            {{ $natureza->descricao }} 
                        </option>
                    @else
                        <option value="{{ $natureza->natureza_id }}" > 
                            {{ $natureza->descricao }} 
                        </option>
                    @endif
                @endforeach    
            </select>

            <label>
                Subcategoria
            </label>
            <input class="w3-input w3-border w3-round w3-margin-bottom" type="text" name="subcategoria"
            id="subcategoria" value="{{ old('subcategoria') ?? $assunto->subcategoria }}" autocomplete="off" required>

            <label>
                Descrição do Assunto
            </label>
            <textarea class="w3-input w3-border w3-round w3-margin-bottom"
                rows="3" 
                name="descricao" 
                id="descricao" 
                autocomplete="off" 
                required
            >{{ old('descricao') ?? $assunto->descricao }}</textarea>

            <button class="w3-btn w3-block w3-theme-l2 w3-round w3-section" type="submit">Editar</button>
        </form>

</x-layout>
