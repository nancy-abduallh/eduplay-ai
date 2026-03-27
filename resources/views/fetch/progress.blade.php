@extends('layouts.app')
@section('title', 'Fetching Courses')

@section('content')

    <div class="progress-scene">
        <div class="progress-shell">

            <div class="spinner-wrap" id="spinnerWrap">
                <div class="spinner-ring"></div>
                <div class="spinner-core"><i class="fas fa-robot"></i></div>
            </div>

            <h2 class="prog-title" id="progTitle">Fetching Courses</h2>
            <p class="prog-sub" id="progSub">
                Processing <strong id="processedCount">0</strong> of
                <strong>{{ $session->total_categories }}</strong> categories...
            </p>

            <div class="prog-bar-bg">
                <div class="prog-bar-fill" id="progFill" style="width: {{ $session->percentage }}%"></div>
            </div>
            <div class="prog-pct" id="progPct">{{ $session->percentage }}%</div>

            <div class="stats-row">
                <div class="stat-tile">
                    <div class="stat-num" id="statProcessed">{{ $session->processed_categories }}</div>
                    <div class="stat-lbl">Processed</div>
                </div>
                <div class="stat-tile">
                    <div class="stat-num" id="statFound">{{ $session->total_found }}</div>
                    <div class="stat-lbl">Playlists Found</div>
                </div>
            </div>

            <div
                style="font-size:0.73rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--gray-3);margin-bottom:0.5rem;">
                <i class="fas fa-layer-group me-1"></i> Categories
            </div>
            <div class="cat-list" id="catList">
                @foreach ($session->categories as $index => $cat)
                    <div class="cat-item" id="cat-{{ $index }}">
                        <span class="s-dot pending" id="dot-{{ $index }}"></span>
                        <span>{{ $cat }}</span>
                    </div>
                @endforeach
            </div>

            <div class="done-banner" id="doneBanner">
                <i class="fas fa-circle-check" style="color:#22C55E;font-size:1.1rem;"></i>
                <div>
                    <strong>All done!</strong> Redirecting you to the course library...
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const sessionId = {{ $session->id }};
        const totalCats = {{ $session->total_categories }};
        const statusUrl = '{{ route('fetch.status', $session->id) }}';
        const coursesUrl = '{{ route('courses.index') }}';
        let pollInterval;
        let lastProcessed = {{ $session->processed_categories }};

        function updateDots(processed) {
            for (let i = 0; i < totalCats; i++) {
                const dot = document.getElementById('dot-' + i);
                if (!dot) continue;
                if (i < processed) {
                    dot.className = 's-dot done';
                } else if (i === processed) {
                    dot.className = 's-dot processing';
                } else {
                    dot.className = 's-dot pending';
                }
            }
        }

        function poll() {
            fetch(statusUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    document.getElementById('progFill').style.width = data.percentage + '%';
                    document.getElementById('progPct').textContent = data.percentage + '%';
                    document.getElementById('processedCount').textContent = data.processed;
                    document.getElementById('statProcessed').textContent = data.processed;
                    document.getElementById('statFound').textContent = data.found;
                    updateDots(data.processed);

                    if (data.status === 'completed') {
                        clearInterval(pollInterval);
                        document.getElementById('spinnerWrap').innerHTML =
                            '<div style="width:80px;height:80px;margin:0 auto;background:rgba(34,197,94,0.12);border:2px solid rgba(34,197,94,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:#22C55E;"><i class="fas fa-check"></i></div>';
                        document.getElementById('progTitle').textContent = 'Fetch Complete!';
                        document.getElementById('progSub').innerHTML = 'Found <strong>' + data.found +
                            '</strong> unique playlists across all categories.';
                        document.getElementById('doneBanner').classList.add('show');
                        for (let i = 0; i < totalCats; i++) {
                            const dot = document.getElementById('dot-' + i);
                            if (dot) dot.className = 's-dot done';
                        }
                        setTimeout(() => {
                            window.location.href = coursesUrl;
                        }, 2800);
                    }
                })
                .catch(() => {});
        }

        updateDots({{ $session->processed_categories }});
        pollInterval = setInterval(poll, 2000);

        if ('{{ $session->status }}' === 'completed') {
            clearInterval(pollInterval);
            document.getElementById('doneBanner').classList.add('show');
            setTimeout(() => {
                window.location.href = coursesUrl;
            }, 1500);
        }
    </script>
@endsection
