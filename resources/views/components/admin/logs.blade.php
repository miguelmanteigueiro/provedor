<x-layout>
    <div class="w3-section">
        <div class="w3-row-padding w3-container">
            <h2><i>Logs</i></h2>
        </div>
    </div>

    <div class="w3-section">
        @if($logs->count())
            <x-admin.load-logs :logs="$logs"/>
        @else
            <div>
                <h1 class="w3-center w3-display-middle">Não existem <i>logs</i>.</h1>
            </div>
        @endif
    </div>

    <div class="w3-section">
        {{ $logs->links() }}
    </div>

</x-layout>
