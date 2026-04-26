@extends('layouts.app')
@section('content')
    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">Manajemen Data Acara</h3>
            <a href="/event/create" class="btn btn-success shadow-sm">
                + Tambah Acara Baru
            </a>
        </div>
        {{-- Menampilkan Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%" class="py-3">No</th>
                                <th class="text-start py-3">Judul Acara</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Tanggal & Lokasi</th>
                                <th class="py-3">Kuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-start">{{ $event->title }}</td>

                                    {{-- [PEMANGGILAN RELASI] Menerjemahkan ID menjadi Nama Kategori --}}
                                    <td class="text-center">
                                        <span class="badge bg-primary">
                                            {{ $event->category->name }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <small
                                            class="d-block fw-bold">{{ date('d M Y', strtotime($event->event_date)) }}</small>
                                        <small class="text-muted">{{ $event->location }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark">{{ $event->quota }} Orang</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted fw-bold">
                                        Belum ada data acara yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
