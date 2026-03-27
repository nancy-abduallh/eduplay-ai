@extends('layouts.app')
@section('title', 'Browse Courses')

@section('content')

    <div class="pg-header">
        <div class="container pg-header-inner">
            <div class="red-line"></div>
            <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
                <div>
                    <h1 class="pg-title">
                        Course Library
                        <span class="cnt-badge">{{ number_format($filteredTotal) }}</span>
                    </h1>
                    <p class="pg-sub">Browse AI-curated educational playlists from YouTube</p>
                </div>
                <a href="{{ route('home') }}" class="btn-red" style="align-self:flex-end;">
                    <i class="fas fa-plus"></i> Fetch More
                </a>
            </div>
        </div>
    </div>

    <div class="filter-bar">
        <div class="container">
            <div class="row align-items-center g-2">
                <div class="col-md-4">
                    <form method="GET" action="{{ route('courses.index') }}" id="filterForm">
                        <div class="search-box">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" name="search" class="search-in" placeholder="Search courses, channels..."
                                value="{{ request('search') }}" onchange="document.getElementById('filterForm').submit()">
                            @if (request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="pill-row">
                        <a href="{{ route('courses.index', array_filter(['search' => request('search')])) }}"
                            class="c-pill {{ !request('category') ? 'active' : '' }}">
                            <i class="fas fa-grip"></i> All
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('courses.index', array_filter(['category' => $cat, 'search' => request('search')])) }}"
                                class="c-pill {{ request('category') === $cat ? 'active' : '' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        @if ($courses->isEmpty())
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-graduation-cap"></i></div>
                <h3 class="empty-title">No courses found</h3>
                <p class="empty-sub">
                    @if (request('search') || request('category'))
                        Try adjusting your filters or search query.
                    @else
                        Start by fetching courses from the home page.
                    @endif
                </p>
                @if (request('search') || request('category'))
                    <a href="{{ route('courses.index') }}" class="btn-ghost-red">
                        <i class="fas fa-xmark"></i> Clear Filters
                    </a>
                @else
                    <a href="{{ route('home') }}" class="btn-red">
                        <i class="fas fa-rocket"></i> Start Fetching
                    </a>
                @endif
            </div>
        @else
            <div class="row g-4">
                @foreach ($courses as $index => $course)
                    <div class="col-sm-6 col-lg-4 scroll-reveal" style="transition-delay:{{ ($index % 6) * 0.07 }}s;">
                        <div class="c-card">
                            <div class="thumb-wrap">
                                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" loading="lazy"
                                    onerror="this.src='https://via.placeholder.com/480x270/1D1919/C41C1C?text=No+Image'">
                                <div class="thumb-overlay">
                                    <div class="play-btn"><i class="fas fa-play"></i></div>
                                </div>
                            </div>
                            <div class="c-body">
                                <div class="c-badge">{{ $course->category }}</div>
                                <div class="c-title">{{ $course->title }}</div>
                                <div class="c-channel">
                                    <i class="fas fa-circle-user"></i>
                                    {{ $course->channel_name }}
                                </div>
                                @if ($course->description)
                                    <p class="c-desc">{{ $course->description }}</p>
                                @endif
                            </div>
                            <div class="c-foot">
                                <span class="c-date">
                                    <i class="far fa-clock" style="color:var(--gray-3);font-size:0.7rem;"></i>
                                    {{ $course->created_at->diffForHumans() }}
                                </span>
                                <a href="{{ route('courses.show', $course->id) }}" class="arrow-link">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($courses->hasPages())
                <div class="pagination-wrapper">
                    {{ $courses->links() }}
                </div>
            @endif
        @endif
    </div>

@endsection
