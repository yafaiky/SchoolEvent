@extends('layouts.app')

@section('title', 'Dashboard') 

@section('content') 
<div class="card border-secondary shadow-sm"> 
    <div class="card-header bg-secondary text-white py-3"> 
        <h5 class="mb-0 fw-bold">Panel Admin</h5> 
    </div> 

    <div class="card-body p-4"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h5 class="text-danger fw-bold mb-0">Daftar Kategori Acara</h5> 
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
                            <td class="fw-bold text-danger">
                                {{ $category->name }}
                            </td> 
                            <td class="text-center">
                                <span class="badge bg-secondary">
                                    {{ $category->slug }}
                                </span>
                            </td> 
                            <td class="text-center">
                                {{ date('d M Y', strtotime($category->created_at)) }}
                            </td> 
                        </tr> 
                    @empty 
                        <tr> 
                            <td colspan="4" class="text-center py-5"> 
                                <p class="text-muted fw-bold mb-0">
                                    Belum ada kategori terdaftar di gudang data.
                                </p> 
                            </td> 
                        </tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 
</div> 
@endsection