@if ($paginator->hasPages())
  <ul class="pagination justify-content-center mt-4">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
      @else
          <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">
              <strong>&lt;&lt;</strong>
            </a>
          </li>
      @endif

      @if($paginator->currentPage() > 3)
          <li class="page-item">
            <a href="{{ $paginator->url(1) }}" class="page-link">
              1
            </a>
          </li>
      @endif
      @if($paginator->currentPage() > 4)
          <li><span>...</span></li>
      @endif

      @foreach(range(1, $paginator->lastPage()) as $i)
          @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
              @if ($i == $paginator->currentPage())
                  <li class="page-item active">
                    <a class="page-link">
                      <span>{{ $i }}</span>
                    </a>
                  </li>
              @else
                  <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($i) }}">
                      {{ $i }}
                    </a>
                  </li>
              @endif
          @endif
      @endforeach
      
      @if($paginator->currentPage() < $paginator->lastPage() - 3)
          <li><span>...</span></li>
      @endif
      @if($paginator->currentPage() < $paginator->lastPage() - 2)
          <li class="page-item">
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">
              {{ $paginator->lastPage() }}
            </a>
          </li>
      @endif

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
          <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="nexPre page-link" >
              <strong>&gt;&gt;</strong>
            </a>
          </li>
      @endif
  </ul>
@endif