<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') — SchoolEvent</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:      #2338A7;
            --primary-dark: #1a2a8a;
            --primary-light:#EEF0FF;
            --bg:           #F5F7FA;
            --white:        #FFFFFF;
            --text:         #111827;
            --text-muted:   #6B7280;
            --border:       #E5E7EB;
            --sidebar-w:    240px;
            --radius:       10px;
            --shadow:       0 2px 8px rgba(0,0,0,.07);
        }

        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== WRAPPER ===== */
        .admin-wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 100vh;
        }

        /* ===== MOBILE TOP BAR ===== */
        .mobile-top-bar {
            display: none;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 12px 20px;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
            width: 100%;
        }

        .mobile-top-brand {
            font-weight: 700;
            color: var(--text);
            font-size: 1.1rem;
        }

        .btn-menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text);
            cursor: pointer;
            padding: 4px;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 20px 16px 16px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-avatar {
            width: 44px;
            height: 44px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .sidebar-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
        }

        .sidebar-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 8px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            overflow-y: auto;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .sidebar-nav a:hover {
            background: var(--bg);
            color: var(--text);
        }

        .sidebar-nav a.active {
            background: var(--primary);
            color: white;
        }

        .sidebar-nav a .nav-icon {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .btn-sidebar-add {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-sidebar-add:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* ===== SIDEBAR OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 95;
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* ===== MAIN AREA ===== */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-w));
        }

        .admin-content {
            flex: 1;
            padding: 32px;
        }

        /* ===== FOOTER ===== */
        .admin-footer {
            background: #F9FAFB;
            border-top: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .admin-footer-copy {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .admin-footer-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .admin-footer-links a {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .admin-footer-links a:hover { color: var(--primary); }

        /* ===== PAGE COMPONENTS ===== */
        .page-header {
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-size: clamp(1.4rem, 4vw, 1.6rem);
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .card-white {
            background: var(--white);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* ===== ALERT ===== */
        .alert-success-custom {
            background: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #065F46;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.875rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ===== TABLE STYLES ===== */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table { width: 100%; border-collapse: collapse; min-width: 600px; }

        .data-table th {
            text-align: left;
            padding: 12px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: #FAFAFA;
            white-space: nowrap;
        }

        .data-table td {
            padding: 14px 16px;
            font-size: 0.875rem;
            border-bottom: 1px solid #F3F4F6;
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: #FAFBFF; }

        /* ===== ACTION BUTTONS ===== */
        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: background 0.15s;
            color: var(--text-muted);
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-icon:hover { background: var(--bg); color: var(--text); }
        .btn-icon.danger:hover { background: #FEE2E2; color: #DC2626; }
        .btn-icon.primary:hover { background: var(--primary-light); color: var(--primary); }

        /* ===== PRIMARY BUTTON ===== */
        .btn-primary-admin {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 9px 16px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: background 0.2s, transform 0.15s;
            white-space: nowrap;
        }

        .btn-primary-admin:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
        }

        /* ===== SECONDARY BUTTON ===== */
        .btn-secondary-admin {
            background: var(--white);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 16px;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-secondary-admin:hover {
            background: var(--bg);
            color: var(--text);
        }

        /* ===== BADGE ===== */
        .badge-category {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            background: #EEF0FF;
            color: var(--primary);
            border: 1px solid #C7D2FE;
            white-space: nowrap;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            font-size: 0.8rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-btns {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pg-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.15s;
        }

        .pg-btn:hover { background: var(--bg); color: var(--text); }
        .pg-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.open {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
                width: 100%;
            }
            .mobile-top-bar {
                display: flex;
            }
            .sidebar-overlay.open {
                display: block;
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 20px 16px;
            }
            .admin-footer {
                padding: 16px;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .admin-footer-links {
                justify-content: center;
            }
            .page-header h1 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            .btn-primary-admin, .btn-secondary-admin {
                width: 100%;
            }
            .pagination-wrap {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>

    @yield('extra_css')
</head>
<body>

<div class="admin-wrapper">
    {{-- ===== MOBILE TOP BAR ===== --}}
    <div class="mobile-top-bar">
        <div class="mobile-top-brand">Admin Panel</div>
        <button class="btn-menu-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>

    {{-- ===== SIDEBAR OVERLAY ===== --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <button class="btn-menu-toggle d-lg-none" id="sidebarClose" style="display:none;">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="sidebar-title">Admin Panel</div>
            <div class="sidebar-subtitle">SMK Plus Pelita...</div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
                Dashboard
            </a>
            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-calendar3"></i></span>
                Manajemen Acara
            </a>
            <a href="{{ route('dashboard') }}#kategori" class="{{ request()->routeIs('category*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="bi bi-diagram-3"></i></span>
                Kategori
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('event.create') }}" class="btn-sidebar-add">
                <i class="bi bi-plus-lg"></i> Tambah Acara
            </a>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="admin-main">
        <div class="admin-content">
            @yield('content')
        </div>

        <footer class="admin-footer">
            <div class="admin-footer-copy">© {{ date('Y') }} SMK Plus Pelita Nusantara. All rights reserved.</div>
            <div class="admin-footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact Us</a>
            </div>
        </footer>
    </div>
</div>

<script>
    const sidebar = document.getElementById('adminSidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('sidebarClose');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    }

    toggleBtn?.addEventListener('click', toggleSidebar);
    closeBtn?.addEventListener('click', toggleSidebar);
    overlay?.addEventListener('click', toggleSidebar);

    // Show close button only on small screens
    if (window.innerWidth <= 992) {
        if(closeBtn) closeBtn.style.display = 'block';
    }
    window.addEventListener('resize', () => {
        if (window.innerWidth <= 992) {
            if(closeBtn) closeBtn.style.display = 'block';
        } else {
            if(closeBtn) closeBtn.style.display = 'none';
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        }
    });
</script>

@yield('extra_js')
</body>
</html>
