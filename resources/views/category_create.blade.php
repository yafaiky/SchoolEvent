@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">Tambah Kategori</div>
            <div class="card-body">
                <form action="/dashboard/category/store" method="POST">
                    @csrf {{-- <--- PENTING: Stempel Keamanan --}}

                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" class="form-control @error('name') isinvalid @enderror">
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>URL Slug</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid
@enderror">
                        @error('slug')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Kategori</button>
                </form>
            </div>
        </div>
    </div>
@endsection
