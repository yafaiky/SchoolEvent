@extends('layouts.main')
@section('title', $event->title . ' - Detail Acara')
@section('meta_desc', 'Detail informasi acara ' . $event->title . ' dari SMK Plus Pelita Nusantara.')

@section('extra_css')
<style>
    :root {
        --primary: #2338A7; --primary-dark: #1a2a8a;
        --primary-light: #EEF0FF; --bg: #F5F7FA;
        --text: #111827; --text-muted: #6B7280; --border: #E5E7EB;
    }

    .detail-wrap {
        max-width: 960px;
        margin: 0 auto;
        padding: 40px 20px 64px;
    }

    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--primary); font-size: 0.85rem; font-weight: 600;
        text-decoration: none; margin-bottom: 24px; transition: gap 0.2s;
    }
    .back-link:hover { gap: 10px; }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 28px;
        align-items: start;
    }

    /* Left: Info */
    .detail-header { margin-bottom: 24px; }

    .detail-category-badge {
        display: inline-block;
        background: #EEF0FF;
        color: var(--primary);
        border: 1px solid #C7D2FE;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .detail-title {
        font-size: clamp(1.4rem, 3.5vw, 2.2rem);
        font-weight: 800;
        color: var(--text);
        letter-spacing: -0.5px;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .detail-meta-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 24px;
    }

    .meta-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .meta-icon {
        width: 38px;
        height: 38px;
        background: var(--primary-light);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .meta-label {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 2px;
    }

    .meta-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
    }

    /* Quota bar */
    .quota-bar-wrap { margin-top: 6px; width: 100%; }

    .quota-bar {
        height: 6px;
        background: #E5E7EB;
        border-radius: 50px;
        overflow: hidden;
    }

    .quota-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), #6366F1);
        border-radius: 50px;
    }

    .quota-text-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.72rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    /* Description */
    .detail-desc-section { margin-bottom: 24px; }

    .section-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .detail-desc {
        font-size: 0.95rem;
        color: var(--text);
        line-height: 1.8;
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
    }

    /* Admin actions */
    .admin-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .btn-detail-edit {
        display: inline-flex; align-items: center; gap: 7px;
        background: white; border: 1.5px solid var(--border);
        color: var(--text); border-radius: 8px; padding: 9px 18px;
        font-size: 0.85rem; font-weight: 600; font-family: 'Inter', sans-serif;
        text-decoration: none; cursor: pointer; transition: all 0.2s;
    }
    .btn-detail-edit:hover { background: var(--bg); color: var(--text); }

    .btn-detail-delete {
        display: inline-flex; align-items: center; gap: 7px;
        background: white; border: 1.5px solid #FCA5A5;
        color: #DC2626; border-radius: 8px; padding: 9px 18px;
        font-size: 0.85rem; font-weight: 600; font-family: 'Inter', sans-serif;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-detail-delete:hover { background: #FEE2E2; }

    /* Right: Poster */
    .detail-poster {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        position: sticky;
        top: 80px;
    }

    .poster-img {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        display: block;
    }

    .poster-placeholder {
        width: 100%;
        aspect-ratio: 3/4;
        background: linear-gradient(135deg, #1e3a5f, #1a6b8a);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.25);
        font-size: 4rem;
    }

    .poster-footer {
        padding: 16px;
        border-top: 1px solid var(--border);
    }

    .btn-register {
        display: block;
        width: 100%;
        text-align: center;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-size: 0.95rem;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-register:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(35,56,167,0.25);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .detail-grid { grid-template-columns: 1fr 300px; }
    }

    @media (max-width: 768px) {
        .detail-grid { grid-template-columns: 1fr; gap: 20px; }
        .detail-poster { position: static; order: -1; }
        .poster-img, .poster-placeholder { aspect-ratio: 16/9; }
    }
    
    @media (max-width: 480px) {
        .detail-wrap { padding: 24px 16px 40px; }
        .detail-meta-card { padding: 16px; }
        .detail-desc { padding: 16px; }
        .admin-actions .btn-detail-edit,
        .admin-actions .btn-detail-delete { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<div class="detail-wrap">
    <a href="{{ route('home') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="detail-grid">
        {{-- ===== LEFT: INFO ===== --}}
        <div>
            {{-- Admin Actions --}}
            @auth
                @if(Auth::user()->isAdmin())
                    <div class="admin-actions">
                        <a href="{{ route('event.edit', $event->id) }}" class="btn-detail-edit">
                            <i class="bi bi-pencil"></i> Edit Acara
                        </a>
                        <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus acara ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-detail-delete">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            {{-- Header --}}
            <div class="detail-header">
                <div class="detail-category-badge">{{ $event->category->name }}</div>
                <h1 class="detail-title">{{ $event->title }}</h1>
            </div>

            {{-- Meta Info --}}
            <div class="detail-meta-card">
                <div class="meta-row">
                    <div class="meta-icon"><i class="bi bi-calendar3"></i></div>
                    <div>
                        <div class="meta-label">Tanggal Acara</div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
                    </div>
                </div>

                <div class="meta-row">
                    <div class="meta-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <div class="meta-label">Lokasi</div>
                        <div class="meta-value">{{ $event->location }}</div>
                    </div>
                </div>

                <div class="meta-row" style="width: 100%;">
                    <div class="meta-icon"><i class="bi bi-people"></i></div>
                    <div style="flex:1;">
                        <div class="meta-label">Kuota Peserta</div>
                        @if($event->quota)
                            <div class="meta-value">{{ number_format($event->quota) }} orang</div>
                            <div class="quota-bar-wrap">
                                <div class="quota-bar">
                                    <div class="quota-bar-fill" style="width: 40%"></div>
                                </div>
                                <div class="quota-text-row">
                                    <span>0 terdaftar</span>
                                    <span>{{ number_format($event->quota) }} kuota</span>
                                </div>
                            </div>
                        @else
                            <div class="meta-value">Tidak terbatas</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="detail-desc-section">
                <div class="section-label">Deskripsi Acara</div>
                <div class="detail-desc">{!! nl2br(e($event->description)) !!}</div>
            </div>
        </div>

        {{-- ===== RIGHT: POSTER ===== --}}
        <div class="detail-poster">
            @if($event->poster)
                <img src="{{ asset('storage/' . $event->poster) }}"
                     class="poster-img" alt="{{ $event->title }}">
            @else
                <div class="poster-placeholder">
                    <i class="bi bi-image"></i>
                </div>
            @endif

            <div class="poster-footer">
                @guest
                    <a href="{{ route('login') }}" class="btn-register">
                        <i class="bi bi-person-plus me-2"></i> Login untuk Daftar
                    </a>
                @endguest
                @auth
                    <a href="#" class="btn-register">
                        <i class="bi bi-send me-2"></i> Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

@endsection
