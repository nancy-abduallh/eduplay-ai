@if ($paginator->hasPages())
<div class="pagination-wrapper">
    <ul class="pagination">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif


        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $start = max($current - 2, 1);
            $end = min($current + 2, $last);
        @endphp


        {{-- First Page --}}
        @if ($start > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            </li>

            @if ($start > 2)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif
        @endif


        {{-- Pages Around Current --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $current)
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endif
        @endfor


        {{-- Last Page --}}
        @if ($end < $last)

            @if ($end < $last - 1)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            @endif

            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a>
            </li>

        @endif


        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
            </li>
        @endif

    </ul>
</div>
@endif
