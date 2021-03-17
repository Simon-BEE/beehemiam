@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end space-x-2">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-primary-200 text-kaki-800 leading-5 rounded-md hover:bg-primary-300 focus:outline-none">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-primary-200 text-kaki-800 leading-5 rounded-md hover:bg-primary-300 focus:outline-none">
                {!! __('pagination.next') !!}
            </a>
        @endif
    </nav>
@endif
