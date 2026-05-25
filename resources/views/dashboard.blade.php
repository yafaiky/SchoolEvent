@extends('layouts.admin')
@section('title', 'Dashboard - Panel Admin')

@section('extra_css')
<style>
    .dashboard-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .date-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 500;
    }

    /* ===== STAT + ACTION CARDS ===== */
    .top-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }

    .top-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
    }

    .top-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .top-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        margin-bottom: 14px;
        background: #EEF0FF;
        color: var(--primary);
    }

    .top-card-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 8px;
    }

    .top-card-number {
        font-size: clamp(1.8rem, 4vw, 2.2rem);
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 6px;
    }

    .top-card-tag {
        display: inline-block;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 50px;
        padding: 2px 8px;
        font-size: 0.7rem;
        font-weight: 600;
        align-self: flex-start;
    }

    .top-card-link {
        text-decoration: none;
    }

    .top-card-action-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 8px;
    }

    .top-card-action-desc {
        font-size: 0.78rem;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* ===== CATEGORY TABLE SECTION ===== */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
    }

    .section-subtitle {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    /* Dot indicator for categories */
    .cat-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .cat-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--primary);
        white-space: nowrap;
    }

    .slug-text {
        font-size: 0.8rem;
        font-family: 'Courier New', monospace;
        color: var(--text-muted);
        background: #F3F4F6;
        padding: 2px 7px;
        border-radius: 5px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .top-cards { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .top-cards { grid-template-columns: 1fr; }
        .dashboard-top { flex-direction: column; }
        .date-chip { width: 100%; justify-content: center; }
        .section-header { flex-direction: column; align-items: flex-start; }
        .section-header .btn-primary-admin { width: 100%; }
    }
</style>
@endsection

@section('content')

{{-- ===== PAGE HEADER ===== --}}
<div class="dashboard-top">
    <div>
        <h1 style="font-size: clamp(1.4rem, 4vw, 1.7rem); font-weight:800; color:var(--text); letter-spacing:-0.5px;">Panel Admin</h1>
        <p style="color:var(--text-muted); font-size:0.875rem; margin-top:4px;">
            Selamat datang kembali. Berikut adalah ringkasan aktivitas dan pintasan aksi Anda hari ini.
        </p>
    </div>
    <div class="date-chip">
        <i class="bi bi-calendar3"></i>
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
</div>

{{-- Notifikasi --}}
@if(session('success'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
@endif

{{-- ===== TOP CARDS ===== --}}
<div class="top-cards">
    {{-- Total Acara --}}
    <div class="top-card">
        <div class="top-card-icon"><i class="bi bi-calendar3"></i></div>
        <div class="top-card-label">Total Acara</div>
        <div class="top-card-number">{{ \App\Models\Event::count() }}</div>
        <span class="top-card-tag">+{{ \App\Models\Event::whereMonth('created_at', now()->month)->count() }} bulan ini</span>
    </div>

    {{-- Tambah Kategori --}}
    <a href="{{ route('category.create') }}" class="top-card top-card-link">
        <div class="top-card-icon" style="background:#EFF6FF; color:#3B82F6;">
            <i class="bi bi-plus-circle"></i>
        </div>
        <div class="top-card-action-title">Tambah Kategori Baru</div>
        <div class="top-card-action-desc">Buat klasifikasi baru untuk mengorganisir acara...</div>
    </a>

    {{-- Tambah Acara --}}
    <a href="{{ route('event.create') }}" class="top-card top-card-link">
        <div class="top-card-icon" style="background:#ECFDF5; color:#10B981;">
            <i class="bi bi-calendar-plus"></i>
        </div>
        <div class="top-card-action-title">Tambah Acara Baru</div>
        <div class="top-card-action-desc">Jadwalkan kegiatan, lomba, atau pertemuan...</div>
    </a>

    {{-- Lihat Halaman Depan --}}
    <a href="{{ route('home') }}" class="top-card top-card-link" target="_blank">
        <div class="top-card-icon" style="background:#FFF7ED; color:#F97316;">
            <i class="bi bi-box-arrow-up-right"></i>
        </div>
        <div class="top-card-action-title">Lihat Halaman Depan</div>
        <div class="top-card-action-desc">Tinjau tampilan publik dari portal acara sekolah Anda.</div>
    </a>
</div>

{{-- ===== CATEGORY TABLE ===== --}}
<div id="kategori">
    <div class="section-header">
        <div>
            <div class="section-title">Daftar Kategori Acara</div>
        </div>
        <a href="{{ route('category.create') }}" class="btn-primary-admin">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>
    <p class="section-subtitle">Kelola semua kategori yang digunakan dalam sistem.</p>

    <div class="card-white">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Kategori</th>
                        <th>URL Slug</th>
                        <th>Tanggal Dibuat</th>
                        <th style="text-align:right; width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $colors = ['#4F46E5','#10B981','#8B5CF6','#F59E0B','#EF4444','#06B6D4']; @endphp
                    @forelse($categories as $category)
                        <tr>
                            <td style="color:var(--text-muted); font-size:0.8rem;">{{ $loop->iteration }}</td>
                            <td>
                                <span class="cat-dot" style="background:{{ $colors[$loop->index % count($colors)] }};"></span>
                                <span class="cat-name">{{ $category->name }}</span>
                            </td>
                            <td><span class="slug-text">{{ $category->slug }}</span></td>
                            <td style="color:var(--text-muted); font-size:0.8rem; white-space:nowrap;">
                                {{ \Carbon\Carbon::parse($category->created_at)->format('d M Y') }}
                            </td>
                            <td>
                                <div style="display:flex; gap:4px; justify-content:flex-end;">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn-icon primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:40px; color:var(--text-muted);">
                                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:8px; opacity:0.3;"></i>
                                Belum ada kategori. <a href="{{ route('category.create') }}" style="color:var(--primary);">Tambahkan sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->count() > 0)
        <div class="pagination-wrap">
            <span>Menampilkan 1 hingga {{ $categories->count() }} dari {{ $categories->count() }} entri</span>
            <div class="pagination-btns">
                <a class="pg-btn"><i class="bi bi-chevron-left"></i></a>
                <span class="pg-btn active">1</span>
                <a class="pg-btn"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
