<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Guesser\Name;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryList = Category::get();

        return view('product.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ], [
            'required' => ':attribute wajib diisi!',
            'unique' => ':attribute sudah ada',
            'category_id.required' => 'Wajib memilih kategori'
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Berhasil menambahkan produk!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categoryList = Category::get();
        
        return view('product.edit', compact('categoryList', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($product);
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ], [
            'required' => ':attribute wajib diisi!',
            'unique' => ':attribute sudah ada',
            'category_id.required' => 'Wajib memilih kategori'
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        // dd($product);
        $product->save();

        return redirect()->route('product.index')->with('success', 'Berhasil mengedit produk!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Berhasil menghapus produk');
    }
}
