<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = Category::when($search, function($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('id')->get();

        return view('admin.categories', compact('categories', 'search'));
    }

   public function store(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);
    Category::create([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
    ]);
    return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
}

    public function update(Request $request, Category $category)
{
    $request->validate(['name' => 'required|string|max:255']);
    $category->update([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name),
    ]);
    return redirect()->back()->with('success', 'Kategori berhasil diupdate!');
}

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}