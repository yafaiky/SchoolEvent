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

    public function edit(Category $category)
    {
        // Melempar data kategori yang ditemukan ke halaman tampilan 
        return view('category_edit', compact('category'));
    }
    // 2. Fungsi Memproses Perubahan Data (UPDATE) 
    public function update(Request $request, Category $category)
    {
        // A. Periksa kelengkapan isi form (Sama seperti Pertemuan 5) 
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        // B. Eloquent ORM: Ubah datanya di database 
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        // C. Tendang kembali ke dashboard dengan membawa pesan sukses 
        return redirect('/dashboard')->with('success', 'Data Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // Eloquent ORM: Hancurkan datanya dari database 
        $category->delete();
        // Tendang kembali ke dashboard dengan membawa pesan sukses 
        return redirect('/dashboard')->with('success', 'Data Kategori berhasil dihapus permanen!');
    }
}
