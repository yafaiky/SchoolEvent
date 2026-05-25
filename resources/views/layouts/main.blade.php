<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SchoolEvent — @yield('title', 'Platform Acara Sekolah')</title>
    <meta name="description" content="@yield('meta_desc', 'Pusat informasi acara dan kegiatan resmi SMK Plus Pelita Nusantara.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #2338A7;
            --primary-dark:  #1a2a8a;
            --primary-light: #EEF0FF;
            --bg:            #F5F7FA;
            --white:         #FFFFFF;
            --text:          #111827;
            --text-muted:    #6B7280;
            --border:        #E5E7EB;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================================================
           NAVBAR
        ================================================ */
        .site-nav {
            background: #151C3B;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            height: 60px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-brand {
            font-size: 1.15rem;
            font-weight: 800;
            color: #FFFFFF;
            text-decoration: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* Search */
        .nav-search {
            flex: 1;
            max-width: 280px;
            position: relative;
        }

        .nav-search input {
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50px;
            padding: 7px 16px 7px 36px;
            color: #fff;
            font-size: 0.84rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: background 0.2s;
        }
        .nav-search input::placeholder { color: #6B7280; }
        .nav-search input:focus { background: rgba(255,255,255,0.13); }
        .nav-search .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-size: 0.85rem;
        }

        /* Desktop Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-left: auto;
        }

        .nav-links a {
            color: #CBD5E1;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .nav-links a:hover, .nav-links a.active { color: #fff; background: rgba(255,255,255,0.08); }
        .nav-links a.active { font-weight: 600; }

        /* Actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn-nav-login {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 0.84rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-nav-login:hover { background: var(--primary-dark); color: white; }

        .nav-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.78rem;
            font-weight: 700;
            border: 2px solid rgba(255,255,255,0.2);
            flex-shrink: 0;
        }

        .btn-nav-logout {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.15);
            color: #94A3B8;
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 0.8rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-nav-logout:hover { border-color: #ef4444; color: #ef4444; }

        /* Hamburger */
        .nav-hamburger {
            display: none;
            background: none;
            border: none;
            color: #CBD5E1;
            font-size: 1.4rem;
            cursor: pointer;
            padding: 4px;
            margin-left: auto;
        }

        /* Mobile Menu Dropdown */
        .nav-mobile-menu {
            display: none;
            background: #1a2347;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .nav-mobile-menu.open { display: block; }

        .nav-mobile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 20px;
            color: #CBD5E1;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            transition: background 0.2s;
        }
        .nav-mobile-menu a:hover { background: rgba(255,255,255,0.05); color: white; }
        .nav-mobile-menu a.active { color: white; font-weight: 600; }

        .nav-mobile-actions {
            padding: 12px 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-mobile-login {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
            flex: 1;
            text-align: center;
        }

        /* ================================================
           MAIN
        ================================================ */
        main { flex: 1; }

        /* ================================================
           FOOTER
        ================================================ */
        .site-footer {
            background: #F9FAFB;
            border-top: 1px solid var(--border);
            padding: 28px 20px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-brand { font-size: 1rem; font-weight: 800; color: var(--text); }

        .footer-links { display: flex; gap: 20px; flex-wrap: wrap; }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.82rem;
            transition: color 0.2s;
        }
        .footer-links a:hover { color: var(--primary); }

        .footer-copy { color: var(--text-muted); font-size: 0.78rem; }

        /* ================================================
           RESPONSIVE BREAKPOINTS
        ================================================ */

        /* ---- Tablet (max 1024px) ---- */
        @media (max-width: 1024px) {
            .nav-search { max-width: 200px; }
        }

        /* ---- Mobile/Tablet (max 768px) ---- */
        @media (max-width: 768px) {
            .nav-search { display: none; }
            .nav-links { display: none; }
            .nav-actions { display: none; }
            .nav-hamburger { display: flex; align-items: center; }

            .footer-inner { flex-direction: column; align-items: flex-start; gap: 12px; }
            .footer-links { gap: 14px; }
        }

        /* ---- Small Mobile (max 480px) ---- */
        @media (max-width: 480px) {
            .nav-inner { padding: 0 16px; }
            .nav-brand { font-size: 1rem; }
        }
    </style>

    @yield('extra_css')
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav class="site-nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-brand">SchoolEvent</a>

        {{-- Desktop Search --}}
        <div class="nav-search">
            <i class="bi bi-search search-icon"></i>
            <input type="text" placeholder="Cari acara..." id="searchInput">
        </div>

        {{-- Desktop Links --}}
        <div class="nav-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('home') }}#katalog">Katalog</a>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                @endif
            @endauth
        </div>

        {{-- Desktop Actions --}}
        <div class="nav-actions">
            @guest
                <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
                <a href="{{ route('register') }}" class="btn-nav-login" style="background:transparent; border:1px solid rgba(255,255,255,0.15); color:#CBD5E1;">Daftar</a>
            @endguest
            @auth
                <div style="color:#CBD5E1; font-size:0.875rem; margin-right:8px;">
                    Halo, <strong style="color:white; font-weight:600;">{{ explode(' ', Auth::user()->name)[0] }}</strong>
                </div>
                <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-nav-logout" title="Keluar">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            @endauth
        </div>

        {{-- Hamburger --}}
        <button class="nav-hamburger" id="navHamburger" aria-label="Menu">
            <i class="bi bi-list" id="hamburgerIcon"></i>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="nav-mobile-menu" id="navMobileMenu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Beranda
        </a>
        <a href="{{ route('home') }}#katalog">
            <i class="bi bi-grid"></i> Katalog Acara
        </a>
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard Admin
                </a>
            @endif
        @endauth

        <div class="nav-mobile-actions">
            @guest
                <a href="{{ route('login') }}" class="btn-mobile-login">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn-mobile-login" style="background:#374151;">
                    Daftar
                </a>
            @endguest
            @auth
                <div style="color:#94A3B8; font-size:0.85rem; flex-basis:100%;">
                    Halo, <strong style="color:white;">{{ Auth::user()->name }}</strong>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="flex:1;">
                    @csrf
                    <button type="submit" class="btn-mobile-login" style="background:#DC2626; border:none; width:100%; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

{{-- ===== MAIN CONTENT ===== --}}
<main>
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">SchoolEvent</div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} SMK Plus Pelita Nusantara. All rights reserved.</div>
    </div>
</footer>

<script>
    // Hamburger toggle
    const hamburger = document.getElementById('navHamburger');
    const mobileMenu = document.getElementById('navMobileMenu');
    const hamburgerIcon = document.getElementById('hamburgerIcon');

    hamburger?.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        const isOpen = mobileMenu.classList.contains('open');
        hamburgerIcon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
    });

    // Search filter (desktop)
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.event-card-item').forEach(card => {
                const title = card.querySelector('.card-event-title')?.textContent.toLowerCase() || '';
                card.style.display = title.includes(q) ? '' : 'none';
            });
        });
    }
</script>

@yield('extra_js')
</body>
</html>
