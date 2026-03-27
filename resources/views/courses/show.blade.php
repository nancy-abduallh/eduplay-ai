@extends('layouts.app')
@section('title', $course->title)

@section('content')

    <section class="course-hero-sec">
        <div class="course-hero-bg">
            <img src="{{ $course->thumbnail_url }}" alt="">
        </div>
        <div class="course-hero-overlay"></div>
        <div class="container course-hero-content">
            <div class="row">
                <div class="col-lg-7">
                    <a href="{{ route('courses.index', ['category' => $course->category]) }}"
                        class="c-badge mb-3 d-inline-block" style="text-decoration:none;">
                        {{ $course->category }}
                    </a>
                    <h1
                        style="font-family:'Syne',sans-serif;font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;letter-spacing:-1px;line-height:1.1;margin-bottom:1rem;">
                        {{ $course->title }}
                    </h1>
                    <div style="display:flex;align-items:center;gap:8px;color:var(--gray-2);font-size:0.88rem;">
                        <i class="fas fa-circle-user" style="color:var(--red);"></i>
                        <span>{{ $course->channel_name }}</span>
                        <span style="color:var(--gray-3);">·</span>
                        <i class="far fa-calendar" style="color:var(--red);"></i>
                        <span>{{ $course->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="course-detail-body">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <div class="col-lg-8">
                    @if ($course->description)
                        <div class="mb-4">
                            <div class="sec-heading">
                                <div class="bar"></div>
                                <h2>About This Playlist</h2>
                                <div class="rule"></div>
                            </div>
                            <p style="color:var(--gray-2);font-size:0.92rem;line-height:1.85;">
                                {{ $course->description }}
                            </p>
                        </div>
                    @endif

                    <div class="detail-block">
                        <div class="detail-block-header">
                            <i class="fas fa-circle-info"></i>
                            Playlist Details
                        </div>
                        <div class="detail-block-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="d-item">
                                        <div class="d-lbl">Playlist ID</div>
                                        <div class="d-val"
                                            style="font-family:monospace;font-size:0.8rem;word-break:break-all;color:var(--red-bright);">
                                            {{ $course->playlist_id }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-item">
                                        <div class="d-lbl">Channel</div>
                                        <div class="d-val">{{ $course->channel_name }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-item">
                                        <div class="d-lbl">Category</div>
                                        <div class="d-val">{{ $course->category }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-item">
                                        <div class="d-lbl">Added</div>
                                        <div class="d-val">{{ $course->created_at->format('F j, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div style="position:sticky;top:100px;">
                        <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}"
                            style="width:100%;border-radius:var(--r-lg);margin-bottom:1.2rem;border:1px solid var(--border);"
                            onerror="this.src='https://via.placeholder.com/480x270/1D1919/C41C1C?text=No+Image'">

                        <a href="{{ $course->youtube_url }}" target="_blank" rel="noopener" class="watch-now">
                            <i class="fab fa-youtube"></i>
                            Watch on YouTube
                        </a>

                        <a href="{{ route('courses.index', ['category' => $course->category]) }}"
                            class="btn-ghost-red w-100 justify-content-center" style="display:flex;">
                            <i class="fas fa-layer-group"></i>
                            More {{ $course->category }} Courses
                        </a>

                        <div
                            style="margin-top:1.2rem;padding:1rem;background:var(--bg-card);border:1px solid var(--border);border-radius:var(--r);text-align:center;">
                            <div
                                style="font-size:0.72rem;color:var(--gray-3);text-transform:uppercase;letter-spacing:1px;font-weight:700;margin-bottom:0.5rem;">
                                Platform</div>
                            <div
                                style="display:flex;align-items:center;justify-content:center;gap:8px;color:var(--red-bright);font-weight:700;">
                                <i class="fab fa-youtube fa-lg"></i> YouTube Playlist
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @if ($related->isNotEmpty())
                <div class="mt-5 pt-4" style="border-top:1px solid var(--border);">
                    <div class="sec-heading">
                        <div class="bar"></div>
                        <h2>Related Courses</h2>
                        <div class="rule"></div>
                    </div>
                    <div class="row g-4">
                        @foreach ($related as $idx => $rel)
                            <div class="col-sm-6 col-lg-3 scroll-reveal" style="transition-delay:{{ $idx * 0.1 }}s;">
                                <div class="c-card">
                                    <div class="thumb-wrap">
                                        <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" loading="lazy"
                                            onerror="this.src='https://via.placeholder.com/480x270/1D1919/C41C1C?text=No+Image'">
                                        <div class="thumb-overlay">
                                            <div class="play-btn"><i class="fas fa-play"></i></div>
                                        </div>
                                    </div>
                                    <div class="c-body">
                                        <div class="c-badge">{{ $rel->category }}</div>
                                        <div class="c-title">{{ $rel->title }}</div>
                                        <div class="c-channel">
                                            <i class="fas fa-circle-user"></i>
                                            {{ $rel->channel_name }}
                                        </div>
                                    </div>
                                    <div class="c-foot">
                                        <span class="c-date">{{ $rel->created_at->diffForHumans() }}</span>
                                        <a href="{{ route('courses.show', $rel->id) }}" class="arrow-link">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
