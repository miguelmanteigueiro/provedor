<footer class="w3-bottom">
    <a id="bottom-filler"><img class="w3-image" style="width:100%" src="/images/login_bg.png"></a>
</footer>

@if (session()->has('mensagem'))
    <section x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 4000)" 
            x-show="show" 
            x-transition.duration.500ms
            class="w3-display-bottomright w3-margin w3-padding w3-round-large w3-theme-l2"
    >
        <b>{{ session('mensagem') }}</b>
    </section>
@endif
