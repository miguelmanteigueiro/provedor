@include('common._head')

<body class="dashboard w3-light-grey">
    <x-dashboard-header/>
    
    <section class="w3-container dashboard-content">
        {{ $slot }}
    </section>

    <x-footer/>
</body>