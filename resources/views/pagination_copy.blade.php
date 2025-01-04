<ul class="pagination justify-content-center">
    {{-- Lien vers la page précédente --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Précédent</span></li>
    @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link">Précédent</a></li>
    @endif

    {{-- Liens vers les pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Lien vers la page suivante --}}
    @if ($paginator->hasMorePages())
        <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">Suivant</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">Suivant</span></li>
    @endif
</ul>
