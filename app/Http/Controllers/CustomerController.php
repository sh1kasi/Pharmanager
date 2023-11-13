<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom wajib diisi!',
            'min' => 'Nama kustomer minimal 3 karakter',
            'max' => 'Nama kustomer maksimal 255 karakter',
            'numeric' => 'Kolom ini hanya bisa diisi dengan angka',
        ];
        $request->validate([
            'name' => 'required|min:3|max:255',
            'address' => 'required',
            'phone' => 'required|numeric'
        ], $messages);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Berhasil mendaftarkan kustomer baru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $messages = [
            'required' => 'Kolom wajib diisi!',
            'min' => 'Nama kustomer minimal 3 karakter',
            'max' => 'Nama kustomer maksimal 255 karakter',
            'numeric' => 'Kolom ini hanya bisa diisi dengan angka',
        ];
        $request->validate([
            'name' => 'required|min:3|max:255',
            'address' => 'required',
            'phone' => 'required|numeric'
        ], $messages);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Berhasil mengedit kustomer!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Berhasil menghapus kustomer');
    }

}
