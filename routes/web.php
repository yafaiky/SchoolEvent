<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontEndController;


//  jalur publik untuk menampilkan halaman depan dengan daftar acara yang sudah dipublikasikan (EAGER LOADING)
Route::get('/', [FrontEndController::class, 'index']);

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

//  Jalur untuk menampilkan halaman edit acara (Perhatikan parameter {event} yang akan digunakan untuk mengambil data yang akan diedit)
Route::get('/event/{event}/edit', [EventController::class, 'edit']);

//  jalur untuk memproses penyimpanan data yang di-edit (Perhatikan method PUT)
Route::put('/event/{event}', [EventController::class, 'update']);

// Jalur untuk memproses penghapusan data (Perhatikan method DELETE)
Route::delete('/event/{event}', [EventController::class, 'destroy']);