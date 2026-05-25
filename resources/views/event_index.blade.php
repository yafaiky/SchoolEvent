@extends('layouts.admin')
@section('title', 'Manajemen Acara')

@section('extra_css')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 16px;
        transition: gap 0.2s;
    }

    .back-link:hover { gap: 10px; }

    .table-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
        gap: 12px;
        flex-wrap: wrap;
    }

    .table-toolbar-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
    }

    .toolbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        background: #F9FAFB;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px 14px 8px 36px;
        font-size: 0.85rem;
        font-family: 'Inter', sans-serif;
        color: var(--text);
        outline: none;
        width: 220px;
        transition: border-color 0.2s;
    }

    .search-box input:focus { border-color: var(--primary); }
    .search-box input::placeholder { color: #9CA3AF; }

    .search-box i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #9CA3AF;
        font-size: 0.85rem;
    }

    /* Table */
    .poster-thumb {
        width: 52px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
        display: block;
    }

    .poster-placeholder-sm {
        width: 52px;
        height: 40px;
        background: #F3F4F6;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #D1D5DB;
        font-size: 1.1rem;
    }

    .event-title-cell {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--text);
        white-space: nowrap;
    }

    .meta-date {
        font-size: 0.8rem;
        color: var(--text);
        font-weight: 500;
        white-space: nowrap;
    }

    .meta-loc {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 2px;
        white-space: nowrap;
    }

    .quota-text {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text);
        white-space: nowrap;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 640px) {
        .table-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .toolbar-right {
            flex-direction: column;
            align-items: stretch;
            width: 100%;
        }
        .search-box input {
            width: 100%;
        }
        .toolbar-right .btn-primary-admin {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')

<a href="{{ route('dashboard') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
</a>

<div class="page-header">
    <h1>Manajemen Data Acara</h1>
    <p>Tambah, edit, atau hapus data acara sekolah.</p>
</div>

@if(session('success'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
@endif

<div class="card-white">
    {{-- Toolbar --}}
    <div class="table-toolbar">
        <div class="table-toolbar-title">Daftar Semua Acara</div>
        <div class="toolbar-right">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="eventSearch" placeholder="Cari acara...">
            </div>
            <a href="{{ route('event.create') }}" class="btn-primary-admin">
                <i class="bi bi-plus-lg"></i> Tambah Acara Baru
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="data-table" id="eventsTable">
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th style="width:70px;">Poster</th>
                    <th>Judul Acara</th>
                    <th>Kategori</th>
                    <th>Tanggal &amp; Lokasi</th>
                    <th>Kuota</th>
                    <th style="text-align:right; width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr class="event-row">
                        <td style="color:var(--text-muted); font-size:0.8rem;">{{ $loop->iteration }}</td>

                        <td>
                            @if($event->poster)
                                <img src="{{ asset('storage/' . $event->poster) }}"
                                     class="poster-thumb" alt="poster">
                            @else
                                <div class="poster-placeholder-sm">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            <span class="event-title-cell event-title-text">{{ $event->title }}</span>
                        </td>

                        <td>
                            <span class="badge-category">{{ $event->category->name }}</span>
                        </td>

                        <td>
                            <div class="meta-date">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</div>
                            <div class="meta-loc">{{ Str::limit($event->location, 25) }}</div>
                        </td>

                        <td>
                            <span class="quota-text">{{ number_format($event->quota) }} Org</span>
                        </td>

                        <td>
                            <div style="display:flex; gap:2px; justify-content:flex-end;">
                                <a href="{{ route('event.show', $event->id) }}" class="btn-icon primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('event.edit', $event->id) }}" class="btn-icon" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus acara ini dan posternya?')">
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
                        <td colspan="7" style="text-align:center; padding:48px; color:var(--text-muted);">
                            <i class="bi bi-calendar-x" style="font-size:2.5rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
                            Belum ada data acara yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination row --}}
    @if($events->count() > 0)
    <div class="pagination-wrap">
        <span>Menampilkan 1–{{ $events->count() }} dari {{ $events->count() }} acara</span>
        <div class="pagination-btns">
            <a class="pg-btn"><i class="bi bi-chevron-left"></i></a>
            <a class="pg-btn active">1</a>
            @if($events->count() > 10)
                <a class="pg-btn">2</a>
            @endif
            <a class="pg-btn"><i class="bi bi-chevron-right"></i></a>
        </div>
    </div>
    @endif
</div>

@endsection

@section('extra_js')
<script>
    document.getElementById('eventSearch')?.addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.event-row').forEach(row => {
            const title = row.querySelector('.event-title-text')?.textContent.toLowerCase() || '';
            row.style.display = title.includes(q) ? '' : 'none';
        });
    });
</script>
@endsection
