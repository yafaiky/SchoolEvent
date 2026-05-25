<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontEndController;

// ============================================================
// RUTE PUBLIK (Bisa diakses siapa saja, termasuk Tamu/Guest)
// ============================================================

// Halaman depan - Katalog acara
Route::get('/', [FrontEndController::class, 'index'])->name('home');


// ============================================================
// RUTE ADMIN - DIJAGA MIDDLEWARE AUTH (Modul 2)
// Hanya pengguna yang sudah login yang boleh masuk!
// Rute spesifik HARUS didefinisikan SEBELUM rute dengan parameter {event}
// ============================================================
Route::middleware(['auth'])->group(function () {

    // Dashboard (Manajemen Kategori)
    Route::get('/dashboard', [CategoryController::class, 'index'])->name('dashboard');

    // Rute Kategori
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/kategori/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Rute Manajemen Acara (rute spesifik /events, /event/create harus di atas)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{event}', [EventController::class, 'destroy'])->name('event.destroy');

    // Rute Profil (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman Detail Acara Dinamis (Modul 3) - publik, didefinisikan SETELAH rute admin
// Karena rute /event/create sudah di-handle di atas oleh middleware auth,
// rute ini hanya akan cocok untuk ID angka yang valid.
Route::get('/event/{event}', [FrontEndController::class, 'show'])->name('event.show');

// Rute Auth (Login, Register, Logout) - dari Breeze
require __DIR__.'/auth.php';
