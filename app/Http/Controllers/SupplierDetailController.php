<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Supplier_Detail;
use App\Http\Controllers\Controller;

class SupplierDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Supplier $supplier)
    {
        $listSupDetail = $supplier->supplier_details()->get();
        return view('supplier.detail.index', compact('listSupDetail', 'supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $products = Product::all();
        $supplier = Supplier::find($id);
        return view('supplier.detail.create', compact('products', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|min:1',
            'price_unit' => 'required',
        ], [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute tidak bisa kurang dari :value'
        ]);

        $supplier_detail = new Supplier_Detail;
        $supplier_detail->supplier_id = $request->supplier_id;
        $supplier_detail->product_id = $request->product_id;
        $supplier_detail->quantity = $request->quantity;
        $supplier_detail->price_unit = str_replace('.', '', $request->price_unit);
        $supplier_detail->save();

        $product = Product::where('id', $supplier_detail->product_id)->first();
        $product->stock += $supplier_detail->quantity;
        $product->save();

        return redirect()->route('supplier.detail.index', $id)->with('success', 'Berhasil menambahkan produk baru');

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier_Detail $supplier_Detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($supplier_id, $id)
    {
        $supplier = Supplier::find($supplier_id);
        $supplier_detail = Supplier_Detail::find($id);
        $products = Product::get();

        return view('supplier.detail.edit', compact('supplier', 'supplier_detail', 'products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier_Detail $supplier_Detail)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier_Detail $supplier_Detail)
    {
        //
    }
}
