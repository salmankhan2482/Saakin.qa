<style>
    .nexPre {
        color: #fff;
        background-color: #009fff !important;
        border-radius: 0.3rem;
        border: 0;
        min-width: 4rem;
        height: 38px !important;
        font-size: 0.7rem !important;
        font-weight: 700;
        text-decoration: none;
    }

</style>

<ul >
    <!-- Previous Page Link -->
    @php
        $geet = $_GET;
        unset($geet['page']);
        $urlstring = http_build_query($geet);
    @endphp
    @if ($paginator->onFirstPage())

    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}&{{ $urlstring }}" rel="prev" class="nexPre">
                < PREV 
            </a>
        </li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li class="disabled">
                <span>{{ $element }}</span>
            </li>
        @endif

        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active">
                        <a href="#">{{ $page }}</a>
                    </li>
                @else
                    <li><a href="{{ $url }}&{{ $urlstring }}">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}&featured={{ request()->get('featured') }}" 
                rel="next" class="nexPre">
                NEXT >
            </a>
        </li>
    @else

    @endif
</ul>
