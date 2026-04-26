<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [CategoryController::class, 'index']);

// Jalur untuk menampilkan halaman input
Route::get('/dashboard/category/create', [CategoryController::class, 'create']);

// Jalur untuk memproses data yang dikirim dari form
Route::post('/dashboard/category/store', [CategoryController::class, 'store']);

// Jalur untuk menampilkan halaman edit (Perhatikan parameter {category} yang akan digunakan untuk mengambil data yang akan diedit)
Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit']); 

// Jalur untuk memproses penyimpanan data yang di-edit (Perhatikan method PUT) 
Route::put('/kategori/{category}', [CategoryController::class, 'update']); 

// Jalur untuk memproses penghapusan data (Perhatikan method DELETE) 
Route::delete('/kategori/{category}', [CategoryController::class, 'destroy']); 

// Jalur untuk menampilkan halaman form input acara baru
Route::get('/event/create', [EventController::class, 'create']); 

// Jalur untuk memproses data yang dikirim dari form input acara baru
Route::post('/event/store', [EventController::class, 'store']);

// Jalur untuk menampilkan daftar acara
Route::get('/events', [EventController::class, 'index']);