@if ($paginator->hasPages())
    <div class="btn-group">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-white disabled">
                <i class="fa fa-chevron-left"></i>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-white">
                <i class="fa fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="btn btn-white disabled">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="btn btn-white active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="btn btn-white">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-white">
                <i class="fa fa-chevron-right"></i>
            </a>
        @else
            <a type="button" class="btn btn-white disabled">
                <i class="fa fa-chevron-right"></i>
            </a>
        @endif
    </div>
@endif
