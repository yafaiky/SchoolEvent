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
        $request->validate([
            'name' => 'required|min:3|unique:categories,name',
            'slug' => 'required|unique:categories,slug'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('dashboard')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('category_edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('dashboard')->with('success', 'Data Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard')->with('success', 'Kategori berhasil dihapus!');
    }
}
