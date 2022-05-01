@include('common._head')

<body class="dashboard w3-light-grey">
    <x-dashboard-header/>

    <section class="w3-container dashboard-content">
        @if (session()->has('login'))
        <section x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 2500)" 
                x-show="show" 
                x-transition.duration.500ms
                class="w3-panel w3-green w3-round-large"
        >
            <h3>{{ session('login') }}</h3>
        </section>
        @endif

        @if (session()->has('sucesso'))
        <section x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 2500)" 
                x-show="show" 
                x-transition.duration.500ms
                class="w3-panel w3-green w3-round-large"
        >
            <h3>Sucesso!</h3>
            <p><b>{{ session('sucesso') }}</b></p>
        </section>
        @endif

        @if (session()->has('aviso'))
        <section x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 5000)" 
                x-show="show" 
                x-transition.duration.500ms
                class="w3-panel w3-amber w3-round-large"
        >
            <h3>Aviso!</h3>
            <p><b>{{ session('aviso') }}</b></p>
        </section>
        @endif
    
        {{ $slot }}
    </section>

    <x-footer/>
</body>