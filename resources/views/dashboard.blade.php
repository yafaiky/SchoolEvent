@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    {{-- Menangkap dan Menampilkan Notifikasi Sukses dari Controller --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" arialabel="Close"></button>
        </div>
    @endif
    <div class="card border-danger shadow-sm">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0 fw-bold">Panel Admin</h5>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-dark fw-bold mb-0">Daftar Kategori Acara</h5>

                <a href="/dashboard/category/create" class="btn btn-success fw-bold shadowsm">
                    + Tambah Kategori Baru
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-start">Nama Kategori</th>
                            <th>URL Slug</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fw-bold text-danger">{{ $category->name }}</td>
                                <td class="text-center"><span class="badge bg-secondary">{{ $category->slug }}</span></td>
                                <td class="text-center">{{ date('d M Y', strtotime($category->created_at)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <p class="text-muted fw-bold mb-0">Belum ada Kategori terdaftar di
                                        gudang data.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
