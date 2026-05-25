@extends('layouts.main')

@section('title', 'Beranda - Platform Acara Sekolah')
@section('meta_desc', 'Pusat informasi dan registrasi seluruh kegiatan ekstrakurikuler, seminar, dan acara spesial di SMK Plus Pelita Nusantara.')

@section('extra_css')
<style>
    :root {
        --primary: #2338A7;
        --primary-dark: #1a2a8a;
        --primary-light: #EEF0FF;
        --bg: #F5F7FA;
        --text: #111827;
        --text-muted: #6B7280;
        --border: #E5E7EB;
    }

    /* ===== HERO ===== */
    .hero-section {
        background: var(--bg);
        padding: 60px 20px 48px;
    }

    .hero-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #EEF0FF;
        color: var(--primary);
        border: 1px solid #C7D2FE;
        border-radius: 50px;
        padding: 5px 14px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .hero-badge::before {
        content: '';
        width: 7px;
        height: 7px;
        background: var(--primary);
        border-radius: 50%;
    }

    .hero-title {
        font-size: clamp(2rem, 4vw + 1rem, 3.2rem);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1px;
        color: var(--text);
        margin-bottom: 16px;
    }

    .hero-title .highlight {
        color: var(--primary);
    }

    .hero-desc {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.75;
        margin-bottom: 28px;
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-hero-primary {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 0.9rem;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-hero-primary:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(35,56,167,0.25);
    }

    .btn-hero-secondary {
        background: white;
        color: var(--text);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 11px 22px;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-hero-secondary:hover {
        background: var(--bg);
        color: var(--text);
        border-color: #CBD5E1;
    }

    /* ===== HERO IMAGE SIDE ===== */
    .hero-image-wrap {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
        width: 100%;
    }

    .hero-img {
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(135deg, #1a6b8a, #0ea5c7);
        aspect-ratio: 4/3;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .hero-floating-card {
        position: absolute;
        bottom: -16px;
        left: -20px;
        background: rgba(10, 10, 30, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 14px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    }

    .floating-icon {
        width: 36px;
        height: 36px;
        background: var(--primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .floating-label {
        font-size: 0.7rem;
        color: #94A3B8;
        font-weight: 500;
        margin-bottom: 2px;
    }

    .floating-value {
        font-size: 0.85rem;
        color: white;
        font-weight: 600;
    }

    /* ===== STATS BAR ===== */
    .stats-bar {
        background: white;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 28px 20px;
    }

    .stats-inner {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 0 32px;
    }

    .stat-item + .stat-item {
        border-left: 1px solid var(--border);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        background: #EEF0FF;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .stat-number {
        font-size: clamp(1.4rem, 3vw, 1.7rem);
        font-weight: 800;
        color: var(--text);
        line-height: 1;
        letter-spacing: -0.5px;
    }

    .stat-label {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-top: 3px;
    }

    /* ===== CATALOG SECTION ===== */
    .catalog-section {
        padding: 56px 20px 64px;
    }

    .catalog-inner { max-width: 1200px; margin: 0 auto; }

    .catalog-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 8px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .catalog-title {
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 800;
        color: var(--text);
        letter-spacing: -0.3px;
    }

    .catalog-subtitle {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 4px;
        margin-bottom: 28px;
    }

    .link-all {
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 28px;
        transition: gap 0.2s;
    }

    .link-all:hover { gap: 8px; }

    /* ===== EVENT CARDS ===== */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .event-card-item {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .event-card-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    }

    .card-image {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: linear-gradient(135deg, #1e3a5f, #1a6b8a);
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .card-category-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(0,0,0,0.55);
        backdrop-filter: blur(8px);
        color: white;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .card-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.3);
        font-size: 2.5rem;
    }

    .card-body {
        padding: 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card-event-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 10px;
        line-height: 1.35;
    }

    .card-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: 16px;
        flex: 1;
    }

    .card-meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .card-meta-item i {
        color: var(--primary);
        font-size: 0.85rem;
        width: 14px;
    }

    .btn-card-detail {
        display: block;
        width: 100%;
        text-align: center;
        padding: 9px;
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text);
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-card-detail:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 3rem;
        opacity: 0.3;
        display: block;
        margin-bottom: 12px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .events-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 900px) {
        .hero-inner { grid-template-columns: 1fr; gap: 40px; text-align: center; }
        .hero-desc { margin: 0 auto 28px; }
        .hero-actions { justify-content: center; }
        .hero-floating-card {
            left: 50%;
            transform: translateX(-50%);
            bottom: -20px;
        }
    }

    @media (max-width: 640px) {
        .hero-section { padding: 40px 16px 32px; }
        .stats-inner { grid-template-columns: 1fr; gap: 16px; }
        .stat-item { padding: 0; justify-content: center; }
        .stat-item + .stat-item { border-left: none; border-top: 1px solid var(--border); padding-top: 16px; margin-top: 0; }
        
        .events-grid { grid-template-columns: 1fr; }
        .catalog-section { padding: 40px 16px; }
        
        .btn-hero-primary, .btn-hero-secondary { width: 100%; }
        
        .hero-floating-card {
            min-width: 200px;
            padding: 10px 12px;
            bottom: -15px;
        }
    }
</style>
@endsection

@section('content')

{{-- ===== HERO ===== --}}
<section class="hero-section">
    <div class="hero-inner">
        {{-- Left: Copy --}}
        <div class="hero-copy">
            <div class="hero-badge">Platform Acara Resmi</div>

            <h1 class="hero-title">
                Temukan Acara &amp; Kegiatan<br>
                <span class="highlight">Terbaik Sekolahmu</span>
            </h1>

            <p class="hero-desc">
                Pusat informasi dan registrasi seluruh kegiatan ekstrakurikuler, seminar, dan
                acara spesial di SMK Plus Pelita Nusantara. Bergabunglah dan kembangkan potensimu.
            </p>

            <div class="hero-actions">
                <a href="#katalog" class="btn-hero-primary">
                    Lihat Katalog <i class="bi bi-arrow-right"></i>
                </a>
                <a href="#katalog" class="btn-hero-secondary">
                    <i class="bi bi-info-circle"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        {{-- Right: Image --}}
        <div class="hero-image-wrap">
            <div class="hero-img">
                <img src="{{ asset('images/hero-students.png') }}"
                     alt="Siswa SMK Plus Pelita Nusantara"
                     onerror="this.style.display='none'; this.parentElement.style.background='linear-gradient(135deg,#1a6b8a,#0ea5c7)'">
            </div>

            {{-- Floating Card --}}
            @if($events->first())
            <div class="hero-floating-card">
                <div class="floating-icon"><i class="bi bi-calendar-event"></i></div>
                <div>
                    <div class="floating-label">Acara Terdekat</div>
                    <div class="floating-value">{{ Str::limit($events->first()->title, 20) }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ===== STATS BAR ===== --}}
<section class="stats-bar">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-icon"><i class="bi bi-calendar3"></i></div>
            <div>
                <div class="stat-number">{{ $events->count() }}+</div>
                <div class="stat-label">Total Acara</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i class="bi bi-diagram-3"></i></div>
            <div>
                <div class="stat-number">{{ $events->pluck('category_id')->unique()->count() }}</div>
                <div class="stat-label">Kategori</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div>
                <div class="stat-number">{{ number_format($events->sum('quota') / 1000, 1) }}k</div>
                <div class="stat-label">Total Kuota Terisi</div>
            </div>
        </div>
    </div>
</section>

{{-- ===== CATALOG ===== --}}
<section class="catalog-section" id="katalog">
    <div class="catalog-inner">
        <div class="catalog-header">
            <div>
                <h2 class="catalog-title">Katalog Acara Terbaru</h2>
            </div>
            <a href="#katalog" class="link-all">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <p class="catalog-subtitle">Jangan lewatkan kegiatan menarik yang akan segera berlangsung.</p>

        <div class="events-grid">
            @forelse($events as $event)
                <div class="event-card-item">
                    <div class="card-image">
                        @if($event->poster)
                            <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->title }}">
                        @else
                            <div class="card-image-placeholder">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                        <span class="card-category-badge">{{ $event->category->name }}</span>
                    </div>

                    <div class="card-body">
                        <h3 class="card-event-title">{{ $event->title }}</h3>

                        <div class="card-meta">
                            <div class="card-meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                        </div>

                        <a href="{{ route('event.show', $event->id) }}" class="btn-card-detail">
                            Lihat Detail Acara
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h5>Belum ada acara yang dipublikasikan.</h5>
                    <p class="small">Cek kembali nanti atau hubungi admin sekolah.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
