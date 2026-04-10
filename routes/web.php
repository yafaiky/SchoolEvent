<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', [CategoryController::class, 'index']);

// Jalur untuk menampilkan halaman input
Route::get('/dashboard/category/create', [CategoryController::class, 'create']);

// Jalur untuk memproses data yang dikirim dari form
Route::post('/dashboard/category/store', [CategoryController::class, 'store']);