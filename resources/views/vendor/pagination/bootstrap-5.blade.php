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

$window = 3;
$half = floor($window / 2);

$start = $current - $half;
$end = $current + $half;

if ($start < 1) {
    $start = 1;
    $end = min($window, $last);
}

if ($end > $last) {
    $end = $last;
    $start = max($last - $window + 1, 1);
}
@endphp


{{-- Show first page if hidden --}}
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


{{-- Sliding window pages --}}
@for ($page = $start; $page <= $end; $page++)
@if ($page == $current)
<li class="page-item active">
<span class="page-link">{{ $page }}</span>
</li>
@else
<li class="page-item">
<a class="page-link" href="{{ $paginator->url($page) }}">
{{ $page }}
</a>
</li>
@endif
@endfor


{{-- Show last page if hidden --}}
@if ($end < $last)

@if ($end < $last - 1)
<li class="page-item disabled">
<span class="page-link">...</span>
</li>
@endif

<li class="page-item">
<a class="page-link" href="{{ $paginator->url($last) }}">
{{ $last }}
</a>
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
