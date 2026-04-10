<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }

    public function create()
    {
        return view('category_create');
    }

    public function store(Request $request)
    {
        // 1. Tahap Pemeriksaan (Validasi)
        $request->validate([
            'name' => 'required|min:3|unique:categories,name',
            'slug' => 'required|unique:categories,slug'
        ]);
        // 2. Tahap Eksekusi Simpan (Eloquent)
        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        // 3. Tahap Feedback (Redirect)
        return redirect('/dashboard')->with('success', 'Kategori Berhasil Disimpan!');
    }
}
