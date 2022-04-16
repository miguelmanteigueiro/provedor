@if ($paginator->hasPages())
    <nav>
        <div class="w3-display-container pagination w3-bar w3-border w3-teal w3-round">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="w3-button disabled " aria-disabled="true"><span>&#10094; Anterior</span></a>
            @else
                <a class="w3-button" href="{{ $paginator->previousPageUrl() }}" rel="prev"><b>&#10094; Anterior</b></a>
            @endif
            <span class="w3-display-middle">Página {!! $paginator->currentPage() !!} de {!! $paginator->lastPage() !!}</span>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="w3-button w3-right" href="{{ $paginator->nextPageUrl() }}" rel="next"><b>Próxima &#10095;</b></a>
            @else
                <a class="w3-button w3-right disabled" aria-disabled="true"><span>Próxima &#10095;</span></a>
            @endif
        </div>
    </nav>
@endif