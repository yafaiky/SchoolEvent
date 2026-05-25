@extends('layouts.admin')
@section('title', 'Tambah Kategori Baru')

@section('extra_css')
<style>
    .form-page-wrap { max-width: 560px; margin: 0 auto; padding: 0 10px; }

    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--primary); font-size: 0.85rem; font-weight: 600;
        text-decoration: none; margin-bottom: 20px; transition: gap 0.2s;
    }
    .back-link:hover { gap: 10px; }

    .form-card {
        background: white; border-radius: 16px;
        border: 1px solid var(--border); padding: 36px;
    }

    .form-card-title {
        font-size: clamp(1.3rem, 3vw, 1.4rem); font-weight: 800; color: var(--text);
        letter-spacing: -0.4px; margin-bottom: 6px;
    }

    .form-card-subtitle {
        font-size: 0.85rem; color: var(--text-muted); margin-bottom: 28px; line-height: 1.6;
    }

    .form-group { margin-bottom: 22px; }

    .form-label {
        display: block; font-size: 0.82rem; font-weight: 600;
        color: var(--text); margin-bottom: 7px;
    }

    .form-input {
        width: 100%; border: 1.5px solid var(--border); border-radius: 8px;
        padding: 10px 14px; font-size: 0.88rem; font-family: 'Inter', sans-serif;
        color: var(--text); background: white; outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input::placeholder { color: #9CA3AF; }
    .form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(35,56,167,0.08); }
    .form-input.is-invalid { border-color: #EF4444; }
    .invalid-msg { color: #DC2626; font-size: 0.78rem; margin-top: 5px; }
    .hint-text { font-size: 0.75rem; color: var(--text-muted); margin-top: 5px; }

    .form-actions {
        display: flex; align-items: center; justify-content: flex-end;
        gap: 12px; margin-top: 28px; padding-top: 24px; border-top: 1px solid var(--border);
    }
    
    @media (max-width: 600px) {
        .form-card { padding: 24px 16px; }
        .form-actions { flex-direction: column-reverse; }
        .form-actions .btn-primary-admin,
        .form-actions .btn-secondary-admin { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<div class="form-page-wrap">
    <a href="{{ route('dashboard') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    <div class="form-card">
        <h1 class="form-card-title">Tambah Kategori Baru</h1>
        <p class="form-card-subtitle">
            Kategori digunakan untuk mengelompokkan jenis-jenis acara sekolah dalam sistem.
        </p>

        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-input @error('name') is-invalid @enderror"
                       placeholder="Contoh: Olahraga, Seni Budaya, Akademik"
                       value="{{ old('name') }}" required autofocus>
                @error('name') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">URL Slug</label>
                <input type="text" name="slug" class="form-input @error('slug') is-invalid @enderror"
                       placeholder="Contoh: olahraga, seni-budaya"
                       value="{{ old('slug') }}" required>
                <div class="hint-text">Gunakan huruf kecil dan tanda hubung, tanpa spasi.</div>
                @error('slug') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-secondary-admin">Batal</a>
                <button type="submit" class="btn-primary-admin">
                    <i class="bi bi-check-circle"></i> Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
