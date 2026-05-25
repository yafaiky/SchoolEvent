<?php

namespace App\Http\Controllers;

use App\Models\Event;

class FrontEndController extends Controller
{
    /**
     * Menampilkan halaman depan dengan katalog semua acara.
     */
    public function index()
    {
        // [EAGER LOADING] Ambil semua data acara dan kategorinya, urutkan dari yang terbaru
        $events = Event::with('category')->latest()->get();
        return view('welcome', compact('events'));
    }

    /**
     * Menampilkan halaman detail satu acara secara dinamis (Modul 3).
     */
    public function show(Event $event)
    {
        // Laravel Route Model Binding otomatis mengambil acara berdasarkan {id}
        $event->load('category');
        return view('event_detail', compact('event'));
    }
}
