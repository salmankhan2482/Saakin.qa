<ul class="pagination justify-content-center mt-4">
  {{-- Previous Page Link --}}
  @php
    $geet = $_GET;
    unset($geet['page']);
    $urlstring = http_build_query($geet);
  @endphp
  @if ($paginator->onFirstPage())
  @else
    <li class="page-item">
      <a href="{{ $paginator->previousPageUrl() }}&{{ $urlstring }}" rel="prev" class="nexPre page-link">
        < PREV </a>
    </li>
  @endif

  {{-- Pagination Elements --}}
  @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
      <li class="page-item disabled">
        <span class="page-link">{{ $element }}</span>
      </li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="page-item active">
            <a href="#" class="page-link">{{ $page }}</a>
          </li>
        @else
          <li class="page-item"><a href="{{ $url }}&{{ $urlstring }}" class="page-link">
              {{ $page }}
            </a>
          </li>
        @endif
      @endforeach
    @endif
  @endforeach

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li class="page-item">
      <a href="{{ $paginator->nextPageUrl() }}&featured={{ request()->get('featured') }}" rel="next" class="nexPre page-link">
        NEXT <i class="fas fa-chevron-right"></i>
      </a>
    </li>
  @else
  @endif
</ul>
