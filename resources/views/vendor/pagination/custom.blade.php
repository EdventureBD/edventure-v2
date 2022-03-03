@if ($paginator->hasPages())
    <ul class="pagination justify-content-start pagination-xsm m-0">
       
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" aria-label="Page" rel="prev">
                    <i class="fas fa-chevron-circle-left"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" aria-label="Page" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="fas fa-chevron-circle-left"></i>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span>{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item disabled">
                            <a class="page-link" aria-label="Page">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" aria-label="Page" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" aria-label="Page" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="fas fa-chevron-circle-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" aria-label="Page" rel="next">
                    <i class="fas fa-chevron-circle-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif 