@if ($paginator->hasPages())
    <div class="flex-l-m flex-w text-center p-t-10 m-lr--7">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="flex-c-m how-pagination1 trans-04 m-all-7 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </a>
        @else
            <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="flex-c-m how-pagination1 trans-04 m-all-7 disabled" aria-disabled="true"><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1" aria-current="page"><span>{{ $page }}</span></a>
                    @else
                        <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        @else
            <a class="flex-c-m how-pagination1 trans-04 m-all-7 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </a>
        @endif
    </div>
@endif
