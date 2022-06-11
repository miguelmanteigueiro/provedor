@props(['naturezas', 'assuntos'])

@if($naturezas->count() || $assuntos->count())

<div class="w3-row-padding">
    <div class="w3-third">
        <fieldset>
            <legend>Choose your monster's features:</legend>

            <div>
                <input type="checkbox" id="scales" name="scales"
                       checked>
                <label for="scales">Scales</label>
            </div>

            <div>
                <input type="checkbox" id="horns" name="horns">
                <label for="horns">Horns</label>
            </div>
        </fieldset>
    </div>

    <div class="w3-third">
        <fieldset>
            <legend>Choose your monster's features:</legend>

            <div>
                <input type="checkbox" id="scales" name="scales"
                       checked>
                <label for="scales">Scales</label>
            </div>

            <div>
                <input type="checkbox" id="horns" name="horns">
                <label for="horns">Horns</label>
            </div>
        </fieldset>
    </div>

    <div class="w3-third">
        <fieldset>
            <legend>Choose your monster's features:</legend>

            <div>
                <input type="checkbox" id="scales" name="scales"
                       checked>
                <label for="scales">Scales</label>
            </div>

            <div>
                <input type="checkbox" id="horns" name="horns">
                <label for="horns">Horns</label>
            </div>
        </fieldset>
    </div>
</div>
    
@else
<h2 class="w3-text w3-center">Ainda não existem naturezas ou assuntos criados.</h2>
@endif
