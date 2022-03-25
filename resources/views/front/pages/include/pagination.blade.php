<style>
    .active-pagination {
    color: #fff;
    background-color: #009fff !important;
    border-radius: 0.3rem;
    border: 0;
    min-width: 2rem;
    height: 38px !important;
    font-size: 0.7rem !important;
    font-weight: 700;
    text-decoration: none;
}
</style>
@if ($paginator->hasPages())
    <ul class="pagination ul-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled prevDesktop"><a style="width: 4rem"><span>« Pre</span></a></li>
        @else
            <li class="prevDesktop"><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="width: 4rem">« Pre</a></li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active"><a class="active-pagination"><span>{{ $i }}</span></a></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="nextDesktop"><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="width: 4rem;">Next »</a></li>
        @else
            <li class="disabled nextDesktop"><a style="width: 4rem;"><span>Next »</span></a></li>
        @endif
    </ul>
@endif