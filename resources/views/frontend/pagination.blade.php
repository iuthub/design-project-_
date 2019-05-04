@if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="btn btn-default">@lang('pagination.previous')</button>
        @else
                <a class="btn btn-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
                <a class="btn btn-primary pull-right" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        @else
            <button class="btn btn-default pull-right">@lang('pagination.next')</button>
        @endif
@endif
