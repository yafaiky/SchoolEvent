<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register &mdash; SchoolEvent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(ellipse at 80% 20%, rgba(6,182,212,0.12) 0%, transparent 55%),
                        radial-gradient(ellipse at 20% 80%, rgba(79,70,229,0.12) 0%, transparent 55%);
            pointer-events: none;
        }

        .auth-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-brand .logo {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #818cf8, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-brand p {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0.4rem 0 0;
        }

        .auth-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.3rem;
        }

        .auth-subtitle {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 1.75rem;
        }

        .form-label-auth {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            margin-bottom: 0.4rem;
        }

        .form-control-auth {
            background: rgba(255,255,255,0.06);
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: white;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control-auth::placeholder { color: #475569; }

        .form-control-auth:focus {
            background: rgba(6,182,212,0.08);
            border-color: #06b6d4;
            box-shadow: 0 0 0 3px rgba(6,182,212,0.12);
            color: white;
            outline: none;
        }

        .btn-auth {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.25s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(6,182,212,0.35);
            color: white;
        }

        .auth-divider {
            text-align: center;
            color: #334155;
            font-size: 0.8rem;
            margin: 1.5rem 0;
            position: relative;
        }

        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0; right: 0;
            height: 1px;
            background: rgba(255,255,255,0.07);
        }

        .auth-divider span {
            background: rgba(15,23,42,0.9);
            padding: 0 1rem;
            position: relative;
        }

        .auth-link {
            color: #06b6d4;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-link:hover { color: #22d3ee; }

        .alert-auth {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            color: #fca5a5;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .field-error {
            color: #f87171;
            font-size: 0.78rem;
            margin-top: 0.3rem;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: #475569;
            font-size: 0.8rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-home a:hover { color: #06b6d4; }
    </style>
</head>
<body>
    <div class="auth-card">
        {{-- Brand --}}
        <div class="auth-brand">
            <div class="logo"><i class="bi bi-calendar-event-fill me-1"></i>SchoolEvent</div>
            <p>SMK Plus Pelita Nusantara</p>
        </div>

        <h2 class="auth-title">Buat Akun Baru</h2>
        <p class="auth-subtitle">Daftar untuk mengelola acara sekolah Anda.</p>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert-auth">
                <i class="bi bi-exclamation-triangle me-2"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label-auth">Nama Lengkap</label>
                <input type="text" name="name" id="name"
                       class="form-control form-control-auth"
                       placeholder="Nama Lengkap Anda"
                       value="{{ old('name') }}" required autofocus>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label-auth">Alamat Email</label>
                <input type="email" name="email" id="email"
                       class="form-control form-control-auth"
                       placeholder="email@sekolah.sch.id"
                       value="{{ old('email') }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label-auth">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control form-control-auth"
                       placeholder="Minimal 8 karakter" required>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label class="form-label-auth">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control form-control-auth"
                       placeholder="Ulangi password Anda" required>
            </div>

            <button type="submit" class="btn-auth btn">
                <i class="bi bi-person-plus me-2"></i> Buat Akun Sekarang
            </button>
        </form>

        <div class="auth-divider"><span>atau</span></div>

        <div class="text-center" style="color:#64748b; font-size:0.875rem;">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
        </div>

        <div class="back-home">
            <a href="{{ route('home') }}"><i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
