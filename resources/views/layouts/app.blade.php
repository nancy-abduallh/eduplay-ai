<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.app_name')) — AI-Powered Educational Playlists</title>
    <meta name="description"
        content="Discover thousands of educational YouTube playlists curated by AI across every subject.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('styles')

    {{-- RTL support --}}
    @if (app()->getLocale() == 'ar')
        <style>
            /* Override Bootstrap grid for RTL */
            .row {
                direction: rtl;
            }

            .pagination .page-link i {
                transform: scaleX(-1);
                display: inline-block;
            }

            .col-1,
            .col-2,
            .col-3,
            .col-4,
            .col-5,
            .col-6,
            .col-7,
            .col-8,
            .col-9,
            .col-10,
            .col-11,
            .col-12,
            .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12,
            .col-md-1,
            .col-md-2,
            .col-md-3,
            .col-md-4,
            .col-md-5,
            .col-md-6,
            .col-md-7,
            .col-md-8,
            .col-md-9,
            .col-md-10,
            .col-md-11,
            .col-md-12,
            .col-lg-1,
            .col-lg-2,
            .col-lg-3,
            .col-lg-4,
            .col-lg-5,
            .col-lg-6,
            .col-lg-7,
            .col-lg-8,
            .col-lg-9,
            .col-lg-10,
            .col-lg-11,
            .col-lg-12 {
                float: right;
            }

            .navbar-nav {
                padding-right: 0;
            }

            .navbar-nav .nav-link i {
                margin-left: 6px;
                margin-right: 0;
            }

            .search-box i {
                left: auto;
                right: 0.9rem;
            }

            .search-in {
                padding-left: 1rem;
                padding-right: 2.3rem;
            }

            .pill-row {
                flex-direction: row-reverse;
                justify-content: flex-start;
            }

            .c-pill i {
                margin-left: 5px;
                margin-right: 0;
            }

            .arrow-link i {
                transform: scaleX(-1);
            }

            .btn-start i,
            .btn-red i,
            .btn-ghost-red i {
                margin-left: 8px;
                margin-right: 0;
            }

            .c-badge,
            .cnt-badge {
                margin-left: 6px;
                margin-right: 0;
            }

            .c-channel i {
                margin-left: 5px;
                margin-right: 0;
            }

            .sec-heading .bar {
                margin-left: 12px;
                margin-right: 0;
            }

            .detail-block-header i {
                margin-left: 7px;
                margin-right: 0;
            }

            .watch-now i {
                margin-left: 8px;
                margin-right: 0;
            }

            footer .text-md-end {
                text-align: left !important;
            }

            .foot-tag i {
                margin-left: 5px;
                margin-right: 0;
            }
        </style>
    @endif

    <style>
        /* ===== SCROLL PROGRESS BAR ===== */
        #scrollProgress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--grad);
            z-index: 10000;
            transition: width 0.1s linear;
            box-shadow: 0 0 6px rgba(196, 28, 28, 0.6);
        }

        /* ===== PROFESSIONAL SCROLLBAR STYLES ===== */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-2);
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--red);
            border-radius: 99px;
            transition: background 0.2s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--red-bright);
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--red) var(--bg-2);
        }

        body.light-mode ::-webkit-scrollbar-track {
            background: #e9ecef;
        }

        body.light-mode ::-webkit-scrollbar-thumb {
            background: var(--red);
        }

        body.light-mode * {
            scrollbar-color: var(--red) #e9ecef;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0.3s, opacity 0.3s;
        }

        .sidebar-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            max-width: 85%;
            height: 100%;
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            z-index: 1001;
            transition: left 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0 0;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.3);
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 0 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 1rem;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 0 0.5rem;
        }

        .sidebar-nav .nav-item {
            list-style: none;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 1rem !important;
            color: var(--gray-2) !important;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
            position: relative;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-nav .nav-link .nav-link-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-nav .nav-link .right-arrow {
            font-size: 0.9rem;
            color: var(--red-bright);
            transition: transform 0.2s ease;
        }

        .sidebar-nav .nav-link:hover .right-arrow {
            transform: translateX(4px);
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: var(--red-dim);
            color: var(--white) !important;
        }

        .sidebar-close {
            position: absolute;
            top: 1.6rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--gray-2);
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 10;
        }

        .sidebar-close:hover {
            color: var(--red-bright);
        }

        .sidebar-footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.5rem;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: var(--gray-3);
            text-align: center;
        }

        .sidebar-footer .footer-powered {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 0.5rem;
        }

        .sidebar-footer .footer-powered i {
            color: var(--red-bright);
            font-size: 0.7rem;
        }

        .sidebar-footer .footer-copyright {
            font-size: 0.7rem;
            opacity: 0.7;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                display: none !important;
            }
        }

        @media (min-width: 992px) {

            .sidebar-overlay,
            .sidebar {
                display: none;
            }
        }

        body.light-mode .sidebar {
            background: var(--bg-card);
            border-left-color: var(--border);
        }

        body.light-mode .sidebar-nav .nav-link:hover,
        body.light-mode .sidebar-nav .nav-link.active {
            background: var(--red-dim);
        }

        body.light-mode .sidebar-close {
            color: var(--gray-3);
        }

        body.light-mode .sidebar-close:hover {
            color: var(--red-bright);
        }

        body[dir="rtl"] .navbar-brand {
            direction: ltr;
            unicode-bidi: embed;
        }
    </style>
</head>

<body>

    <!-- Scroll progress bar -->
    <div id="scrollProgress"></div>

    <div class="c-dot" id="cDot"></div>
    <div class="c-ring" id="cRing"></div>

    <nav class="navbar navbar-expand-lg" id="mainNav">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                @if (app()->getLocale() === 'en')
                    <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                    EduPlay<span class="brand-ai">AI</span>
                @else
                    <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                    <span class="brand-ai">AI</span>EduPlay
                @endif
            </a>
            <button class="navbar-toggler" type="button" id="mobileMenuToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-house"></i> {{ __('messages.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}"
                            href="{{ route('courses.index') }}">
                            <i class="fas fa-graduation-cap"></i> {{ __('messages.courses') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <button id="themeToggle" class="nav-link" style="background: none; border: none;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                    {{-- Language Switcher --}}
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" id="langDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                           <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}">English</a></li>
                           <li><a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="sidebar" id="sidebar">
        <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
        <div class="sidebar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                @if (app()->getLocale() === 'en')
                    <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                    EduPlay<span class="brand-ai">AI</span>
                @else
                    <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                    <span class="brand-ai">AI</span>EduPlay
                @endif
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <span class="nav-link-content">
                        <i class="fas fa-house"></i> {{ __('messages.home') }}
                    </span>

                    @if (app()->getLocale() === 'en')
                        <i class="fas fa-arrow-right right-arrow"></i>
                    @else
                        <i class="fas fa-arrow-left right-arrow"></i>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}"
                    href="{{ route('courses.index') }}">
                    <span class="nav-link-content">
                        <i class="fas fa-graduation-cap"></i> {{ __('messages.courses') }}
                    </span>
                    @if (app()->getLocale() === 'en')
                        <i class="fas fa-arrow-right right-arrow"></i>
                    @else
                        <i class="fas fa-arrow-left right-arrow"></i>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <button id="themeToggleSidebar" class="nav-link">
                    <span class="nav-link-content">
                        <i class="fas fa-moon"></i> {{ __('messages.theme') }}
                    </span>
                    @if (app()->getLocale() === 'en')
                        <i class="fas fa-arrow-right right-arrow"></i>
                    @else
                        <i class="fas fa-arrow-left right-arrow"></i>
                    @endif
                </button>
            </li>
            {{-- Language Switcher in Sidebar --}}
            <li class="nav-item">
                <div class="nav-link" style="justify-content: space-between;">
                    <span class="nav-link-content">
                        <i class="fas fa-globe"></i> {{ __('messages.language') ?? 'Language' }}
                    </span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('language.switch', 'en') }}" class="btn btn-sm btn-outline-dark" style="font-size:0.7rem;">EN</a>
                        <a href="{{ route('language.switch', 'ar') }}" class="btn btn-sm btn-outline-dark" style="font-size:0.7rem;">AR</a>
                    </div>
                </div>
            </li>
        </ul>
        <div class="sidebar-footer">
            <div class="footer-powered">
                <i class="fas fa-bolt"></i> {{ __('messages.powered_by') }}
            </div>
            <div class="footer-copyright">
                &copy; {{ date('Y') }} EduPlayAI — {{ __('messages.copyright') }}
            </div>
        </div>
    </div>

    <main>@yield('content')</main>

    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="foot-brand">
                        @if (app()->getLocale() === 'en')
                            <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                            EduPlay<span class="brand-ai">AI</span>
                        @else
                            <div class="logo-mark"><i class="fab fa-youtube"></i></div>
                            <span class="brand-ai">AI</span>EduPlay
                        @endif
                    </div>
                    <p class="foot-text">{{ __('messages.ai_powered_course_discovery') }}</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('home') }}" class="btn-ghost-red btn-sm"
                        style="font-size:0.8rem;padding:0.45rem 1rem;">
                        <i class="fas fa-rocket"></i> {{ __('messages.start_fetching') }}
                    </a>
                </div>
            </div>
            <div class="foot-divider"></div>
            <div class="foot-bottom">
                <span class="foot-copy">
                    &copy; {{ date('Y') }} EduPlayAI. {{ __('messages.copyright') }}
                    {{ __('messages.created_by') }}
                    <a href="https://nancy-abduallh.github.io/My-Portfolio/" target="_blank" rel="noopener">
                        Nancy Abdullah
                    </a>
                </span>
                <span class="foot-tag">
                    <i class="fas fa-bolt"></i> {{ __('messages.powered_by') }}
                </span>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // ---------- CUSTOM CURSOR ----------
        const dot = document.getElementById('cDot');
        const ring = document.getElementById('cRing');
        let mx = 0,
            my = 0,
            rx = 0,
            ry = 0;

        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
        });

        function animateCursor() {
            dot.style.left = mx + 'px';
            dot.style.top = my + 'px';
            rx += (mx - rx) * 0.14;
            ry += (my - ry) * 0.14;
            ring.style.left = rx + 'px';
            ring.style.top = ry + 'px';
            requestAnimationFrame(animateCursor);
        }
        animateCursor();

        document.querySelectorAll('a, button, .c-card, input, textarea, .c-pill, .arrow-link').forEach(el => {
            el.addEventListener('mouseenter', () => ring.classList.add('on'));
            el.addEventListener('mouseleave', () => ring.classList.remove('on'));
        });

        // ---------- NAVBAR SHRINK ON SCROLL ----------
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => nav.classList.toggle('shrink', window.scrollY > 40));

        // ---------- SCROLL REVEAL ----------
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('revealed');
            });
        }, {
            threshold: 0.08
        });
        document.querySelectorAll('.scroll-reveal').forEach(el => io.observe(el));

        // ---------- THEME TOGGLE (shared function) ----------
        function toggleTheme() {
            document.body.classList.toggle('light-mode');
            const isLight = document.body.classList.contains('light-mode');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            const mainIcon = document.querySelector('#themeToggle i');
            const sidebarIcon = document.querySelector('#themeToggleSidebar i');
            if (mainIcon) mainIcon.className = isLight ? 'fas fa-moon' : 'fas fa-sun';
            if (sidebarIcon) sidebarIcon.className = isLight ? 'fas fa-moon' : 'fas fa-sun';
        }

        const currentTheme = localStorage.getItem('theme') || 'dark';
        if (currentTheme === 'light') {
            document.body.classList.add('light-mode');
            document.querySelector('#themeToggle i').className = 'fas fa-moon';
            document.querySelector('#themeToggleSidebar i').className = 'fas fa-moon';
        } else {
            document.body.classList.remove('light-mode');
            document.querySelector('#themeToggle i').className = 'fas fa-sun';
            document.querySelector('#themeToggleSidebar i').className = 'fas fa-sun';
        }

        const themeToggleMain = document.getElementById('themeToggle');
        const themeToggleSidebar = document.getElementById('themeToggleSidebar');
        if (themeToggleMain) themeToggleMain.addEventListener('click', toggleTheme);
        if (themeToggleSidebar) themeToggleSidebar.addEventListener('click', toggleTheme);

        // ---------- MOBILE SIDEBAR ----------
        const toggleBtn = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const closeBtn = document.getElementById('sidebarClose');

        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openSidebar();
        });
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        const sidebarLinks = document.querySelectorAll('.sidebar-nav .nav-link');
        sidebarLinks.forEach(link => link.addEventListener('click', closeSidebar));

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992 && sidebar.classList.contains('active')) closeSidebar();
        });

        // ---------- SCROLL PROGRESS BAR ----------
        const progressBar = document.getElementById('scrollProgress');
        window.addEventListener('scroll', () => {
            const winScroll = document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        });
    </script>
    @yield('scripts')
</body>

</html>
