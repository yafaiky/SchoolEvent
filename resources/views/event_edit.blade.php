@extends('layouts.admin')
@section('title', 'Edit Acara - ' . $event->title)

@section('extra_css')
<style>
    .form-page-wrap { max-width: 740px; margin: 0 auto; padding: 0 10px; }

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
        font-size: clamp(1.3rem, 3vw, 1.5rem); font-weight: 800; color: var(--text);
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

    .form-label .optional { color: var(--text-muted); font-weight: 400; }

    .form-input {
        width: 100%; border: 1.5px solid var(--border); border-radius: 8px;
        padding: 10px 14px; font-size: 0.88rem; font-family: 'Inter', sans-serif;
        color: var(--text); background: white; outline: none;
        transition: border-color 0.2s, box-shadow 0.2s; appearance: none;
    }
    .form-input::placeholder { color: #9CA3AF; }
    .form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(35,56,167,0.08); }
    .form-input.is-invalid { border-color: #EF4444; }
    .invalid-msg { color: #DC2626; font-size: 0.78rem; margin-top: 5px; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .upload-area {
        border: 2px dashed #D1D5DB; border-radius: 10px; padding: 28px 20px;
        text-align: center; cursor: pointer; background: #FAFAFA; transition: all 0.2s;
    }
    .upload-area:hover { border-color: var(--primary); background: #EEF0FF; }

    .upload-icon {
        width: 48px; height: 48px; background: #EEF0FF; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--primary); font-size: 1.3rem; margin: 0 auto 12px;
    }

    .current-poster {
        max-height: 180px; max-width: 100%; border-radius: 8px;
        margin-bottom: 10px; display: block; margin-left: auto; margin-right: auto;
    }

    #newPosterPreview {
        max-height: 180px; max-width: 100%; border-radius: 8px;
        margin-bottom: 10px; display: none; margin-left: auto; margin-right: auto;
    }

    .form-actions {
        display: flex; align-items: center; justify-content: flex-end;
        gap: 12px; margin-top: 28px; padding-top: 24px; border-top: 1px solid var(--border);
    }

    @media (max-width: 600px) {
        .form-card { padding: 24px 16px; }
        .form-row { grid-template-columns: 1fr; }
        .form-actions { flex-direction: column-reverse; }
        .form-actions .btn-primary-admin,
        .form-actions .btn-secondary-admin { width: 100%; justify-content: center; }
        .form-input[name="quota"] { max-width: 100% !important; }
    }
</style>
@endsection

@section('content')

<div class="form-page-wrap">
    <a href="{{ route('events.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i> Kembali ke Manajemen Acara
    </a>

    <div class="form-card">
        <h1 class="form-card-title">Edit Data Acara</h1>
        <p class="form-card-subtitle">Ubah informasi acara "<strong>{{ $event->title }}</strong>" di bawah ini.</p>

        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Kategori --}}
            <div class="form-group">
                <label class="form-label">Kategori Acara</label>
                <select name="category_id" class="form-input @error('category_id') is-invalid @enderror" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Judul --}}
            <div class="form-group">
                <label class="form-label">Judul Acara</label>
                <input type="text" name="title" class="form-input @error('title') is-invalid @enderror"
                       value="{{ old('title', $event->title) }}" required>
                @error('title') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Tanggal & Lokasi --}}
            <div class="form-group">
                <div class="form-row">
                    <div>
                        <label class="form-label">Tanggal Acara</label>
                        <input type="date" name="event_date" class="form-input @error('event_date') is-invalid @enderror"
                               value="{{ old('event_date', $event->event_date) }}" required>
                        @error('event_date') <div class="invalid-msg">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="form-label">Lokasi Acara</label>
                        <input type="text" name="location" class="form-input @error('location') is-invalid @enderror"
                               value="{{ old('location', $event->location) }}" required>
                        @error('location') <div class="invalid-msg">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Kuota --}}
            <div class="form-group">
                <label class="form-label">Kuota Peserta <span class="optional">(Opsional)</span></label>
                <input type="number" name="quota" class="form-input @error('quota') is-invalid @enderror"
                       value="{{ old('quota', $event->quota) }}" min="1" style="max-width:300px;">
                @error('quota') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label class="form-label">Deskripsi Acara</label>
                <textarea name="description" class="form-input @error('description') is-invalid @enderror"
                          rows="5" required>{{ old('description', $event->description) }}</textarea>
                @error('description') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Poster --}}
            <div class="form-group">
                <label class="form-label">Poster / Banner <span class="optional">(Kosongkan jika tidak diganti)</span></label>
                <div class="upload-area" onclick="document.getElementById('poster').click()">
                    @if($event->poster)
                        <img id="newPosterPreview" src="" alt="">
                        <img id="currentPoster" src="{{ asset('storage/' . $event->poster) }}"
                             class="current-poster" alt="Poster saat ini">
                        <div id="uploadPlaceholder" style="display:none;">
                            <div class="upload-icon"><i class="bi bi-cloud-upload"></i></div>
                        </div>
                        <div style="font-size:0.75rem; color:var(--text-muted); margin-top:8px;">
                            <i class="bi bi-info-circle me-1"></i>Klik untuk ganti poster
                        </div>
                    @else
                        <img id="newPosterPreview" src="" alt="">
                        <div id="uploadPlaceholder">
                            <div class="upload-icon"><i class="bi bi-cloud-upload"></i></div>
                            <div style="font-size:0.9rem; font-weight:700; color:var(--text); margin-bottom:4px;">Klik untuk pilih gambar</div>
                            <div style="font-size:0.78rem; color:var(--text-muted);">Maksimal 5MB (Format: JPG, PNG)</div>
                        </div>
                    @endif
                </div>
                <input type="file" id="poster" name="poster" accept="image/*"
                       style="display:none;" onchange="previewImage()">
                @error('poster') <div class="invalid-msg">{{ $message }}</div> @enderror
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <a href="{{ route('events.index') }}" class="btn-secondary-admin">Batal</a>
                <button type="submit" class="btn-primary-admin">
                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('extra_js')
<script>
    function previewImage() {
        const input = document.getElementById('poster');
        const newPreview = document.getElementById('newPosterPreview');
        const currentPoster = document.getElementById('currentPoster');
        const placeholder = document.getElementById('uploadPlaceholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                newPreview.src = e.target.result;
                newPreview.style.display = 'block';
                if (currentPoster) currentPoster.style.display = 'none';
                if (placeholder) placeholder.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection