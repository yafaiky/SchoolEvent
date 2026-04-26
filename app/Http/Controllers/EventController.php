<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // [EAGER LOADING] Mengambil semua acara beserta relasi kategorinya
        // JANGAN GUNAKAN: Event::all(); (Ini akan menyebabkan N+1 Problem)
        $events = Event::with('category')->latest()->get();

        return view('event_index', compact('events'));
    }

    public function create()
    {
        // Ambil semua daftar kategori dari database 
        $categories = Category::all();
        // Lempar ke halaman form agar bisa dijadikan pilihan Dropdown 
        return view('event_create', compact('categories'));
    }
    // Fungsi Store (Simpan Data) sama persis dengan konsep Pertemuan 5 
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'quota' => 'required',
            'description' => 'required'
        ]);
        Event::create($request->all());
        return redirect('/dashboard')->with('success', 'Acara Baru Berhasil Ditambahkan!');
    }
}
