<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'description' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // Validasi keamanan file 
        ]);

        $data = $request->all();
        // Menyimpan aset fisik ke hardisk 
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);
        return redirect('/events')->with('success', 'Acara dan Poster berhasil dipublikasi!');
    }

    // FUNGSI 2: EDIT (Menampilkan halaman form edit) 
    public function edit(Event $event)
    {
        $categories = Category::all(); // Membawa data relasi untuk dropdown 
        return view('event_edit', compact('event', 'categories'));
    }

    // FUNGSI 3: UPDATE (Algoritma Garbage Collection) 
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'event_date' => 'required',
            'location' => 'required',
            'quota' => 'required',
            'description' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('poster')) {
            // [GARBAGE COLLECTION] Hancurkan fisik poster lama! 
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            // Setelah hancur, simpan poster barunya 
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);
        return redirect('/events')->with('success', 'Data Acara sukses diperbarui!');
    }

    // FUNGSI 4: DELETE (Pemusnahan Data Total) 
    public function destroy(Event $event)
    {
        // [GARBAGE COLLECTION] Hancurkan fisik poster terlebih dahulu! 
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }
        // Setelah fisiknya musnah dari server, hapus catatan datanya dari Database 
        $event->delete();
        return redirect('/events')->with('success', 'Acara dan fisik posternya telah dimusnahkan!');
    }
}
