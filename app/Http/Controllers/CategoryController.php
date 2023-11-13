<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'unique:categories' => ':attribute sudah ada!',
        ];

        $request->validate([
            'name' => 'required|unique:categories' , 
        ], $messages);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Berhasil membuat kategori baru!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $messages = [
            'name.required' => ":attribute tidak boleh kosong!",
            'name.unique' => ":attribute sudah ada!",
        ];

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ], $messages);
        
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Berhasil mengedit kategori!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Berhasil menghapus kategori');
    }
}
