<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::get();

        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|unique:suppliers,deleted_at,NULL',
        ],[
            'required' => ':attribute wajib diisi!',
            'min' => 'attribute tidak bisa kurang dari 5 karakter!',
        ]);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Berhasil menambahkan supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|min:5|unique:suppliers,name,' . $supplier->id . ',deleted_at,NULL',
        ],[
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute tidak bisa kurang dari :value karakter!',
            'unique' => ':attribute sudah ada'
        ]);

        $supplier->name = $request->name;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Berhasil menambahkan supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // dd($supplier);
        $supplier->delete();
        $supplier->supplier_details()->delete();

        return redirect()->route('supplier.index')->with('success', 'Berhasil menghapus supplier');
    }
}
