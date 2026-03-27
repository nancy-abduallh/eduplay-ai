@extends('layouts.app')
@section('title', __('messages.home'))

@section('content')

    <section class="hero">
        <div class="hero-bg-radial"></div>
        <div class="hero-grid-lines"></div>
        <div class="hero-orb"></div>

        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-eyebrow">
                        <span class="live-dot"></span>
                        {{ __('messages.ai_powered_course_discovery') }}
                    </div>

                    <h1 class="hero-h1">
                        {{ __('messages.discover_worlds_best') }}<br>
                        {{ __('messages.worlds_best') }}<br>
                        <span class="grad-text">{{ __('messages.educational_playlists') }}</span><br>
                    </h1>

                    <p class="hero-sub">
                        {{ __('messages.hero_sub') }}
                    </p>

                    @if ($errors->any())
                        <div class="mb-3 p-3"
                            style="background:rgba(196,28,28,0.1);border:1px solid rgba(196,28,28,0.3);border-radius:12px;">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0" style="font-size:0.85rem;color:#FF2D2D;"><i
                                        class="fas fa-circle-xmark me-2"></i>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('fetch.start') }}" method="POST" id="fetchForm">
                        @csrf
                        <div class="form-wrap">
                            <div class="form-lbl">
                                <i class="fas fa-list-ul"></i> {{ __('messages.categories_one_per_line') }}
                            </div>
                            <textarea name="categories" class="cat-textarea" id="catTextarea"
                                placeholder="Marketing&#10;Programming&#10;Graphic Design&#10;Business&#10;Engineering" spellcheck="false">{{ old('categories') }}</textarea>
                            <div class="form-footer">
                                <span class="form-hint">
                                    <i class="fas fa-circle-info"></i>
                                    <span id="lineCount">0</span> {{ __('messages.categories_detected') }}
                                </span>
                                <button type="submit" class="btn-start" id="startBtn">
                                    <i class="fas fa-rocket"></i>
                                    <span id="btnText">{{ __('messages.start_fetching') }}</span>
                                    <span id="btnSpinner" style="display:none;">
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-deco">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="deco-card float-1">
                                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:0.8rem;">
                                        <div
                                            style="width:10px;height:10px;background:#22C55E;border-radius:50%;animation:blink-anim 1.5s ease-in-out infinite;">
                                        </div>
                                        <span
                                            style="font-size:0.75rem;color:var(--gray-3);font-weight:600;text-transform:uppercase;letter-spacing:1px;">{{ __('messages.ai_generating_queries') }}</span>
                                    </div>
                                    <div
                                        style="background:var(--bg-2);border-radius:10px;padding:0.9rem 1rem;font-size:0.82rem;color:var(--gray-2);line-height:2;">
                                        <div style="color:var(--red-bright);">→</div>
                                        {{ __('messages.complete_python_programming') }}<br>
                                        <div style="color:var(--red-bright);">→</div>
                                        {{ __('messages.advanced_machine_learning') }}<br>
                                        <div style="color:var(--red-bright);">→</div>
                                        {{ __('messages.full_stack_web_dev') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="deco-card float-2" style="height:100%;">
                                    <img src="https://img.youtube.com/vi/rfscVS0vtbw/hqdefault.jpg" alt=""
                                        class="deco-img">
                                    <div style="margin-top:0.7rem;">
                                        <div class="c-badge">{{ __('messages.programming') ?? 'Programming' }}</div>
                                        <div
                                            style="font-size:0.82rem;font-weight:600;color:var(--white);line-height:1.3;margin-top:0.3rem;">
                                            Learn Python - Full Course</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="d-flex flex-column gap-3">
                                    <div class="deco-card-sm float-3 text-center">
                                        <div
                                            style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--red-bright);">
                                            {{ number_format($stats['total_courses']) }}</div>
                                        <div
                                            style="font-size:0.68rem;color:var(--gray-3);text-transform:uppercase;letter-spacing:1px;font-weight:700;">
                                            {{ __('messages.playlists_stored') }}</div>
                                    </div>
                                    <div class="deco-card-sm float-1 text-center">
                                        <div
                                            style="font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--red-bright);">
                                            {{ number_format($stats['total_categories']) }}</div>
                                        <div
                                            style="font-size:0.68rem;color:var(--gray-3);text-transform:uppercase;letter-spacing:1px;font-weight:700;">
                                            {{ __('messages.categories') }}</div>
                                    </div>
                                    <div class="deco-card-sm float-2"
                                        style="background:var(--red-dim);border-color:var(--red-border);">
                                        <div
                                            style="font-size:0.75rem;color:var(--red-bright);font-weight:700;margin-bottom:0.2rem;">
                                            <i class="fas fa-bolt"></i> {{ __('messages.powered_by_ai') }}
                                        </div>
                                        <div style="font-size:0.7rem;color:var(--gray-2);">OpenAI GPT + YouTube API</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="text-center mb-5">
                <div class="red-line"></div>
                <h2 style="font-family:'Syne',sans-serif;font-size:1.8rem;font-weight:800;letter-spacing:-0.8px;"
                    class="scroll-reveal">{{ __('messages.how_it_works') }}</h2>
                <p style="color:var(--gray-2);font-size:0.9rem;max-width:420px;margin:0.5rem auto 0;" class="scroll-reveal">
                    {{ __('messages.three_intelligent_steps') }}</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 scroll-reveal">
                    <div class="feat-card">
                        <div class="feat-icon-wrap"><i class="fas fa-brain"></i></div>
                        <h3 class="feat-title">{{ __('messages.ai_title_generation') }}</h3>
                        <p class="feat-text">{{ __('messages.ai_title_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-4 scroll-reveal" style="transition-delay:0.12s;">
                    <div class="feat-card">
                        <div class="feat-icon-wrap"><i class="fab fa-youtube"></i></div>
                        <h3 class="feat-title">{{ __('messages.youtube_discovery') }}</h3>
                        <p class="feat-text">{{ __('messages.youtube_discovery_desc') }}</p>
                    </div>
                </div>
                <div class="col-md-4 scroll-reveal" style="transition-delay:0.24s;">
                    <div class="feat-card">
                        <div class="feat-icon-wrap"><i class="fas fa-filter"></i></div>
                        <h3 class="feat-title">{{ __('messages.smart_deduplication') }}</h3>
                        <p class="feat-text">{{ __('messages.smart_deduplication_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        const ta = document.getElementById('catTextarea');
        const cnt = document.getElementById('lineCount');
        const form = document.getElementById('fetchForm');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');

        function countLines() {
            const lines = ta.value.split('\n').filter(l => l.trim().length > 0);
            cnt.textContent = lines.length;
        }

        ta.addEventListener('input', countLines);
        countLines();

        form.addEventListener('submit', () => {
            btnText.innerHTML = 'Processing...';
            btnSpinner.style.display = 'inline';
        });
    </script>
@endsection
