<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        $products = Product::get();
        $carts = Cart::content();

        return view('cashier.index', compact('customers', 'products', 'carts'));
    }

    public function addCartItem(Request $request) {
        $rules = [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        Cart::add([
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'qty' => 1,
            'price' => $validatedData['price']
        ]);

        return redirect()->back()->with('success', 'berhasil menambahkan produk ke keranjang!');
    }

    public function removeCartItem($rowId) {
        Cart::remove($rowId);

        return redirect()->back()->with('success', 'Berhasil menghapus produk dari keranjang!');
    }

    public function updateCartItem(Request $request, $rowId) {
        $rules = [
            'qty' => 'required|numeric',
        ];

        $request->validate($rules, [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute tidak wajib angka!',
        ]);

        // dd();

        $product = Product::find(Cart::content()[$rowId]->id);

        if ($product->stock >= $request->qty) {
            Cart::update($rowId, $request->qty);
        } else {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
        }





        return redirect()->back()->with('success', 'Berhasil menambah jumlah produk!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashier $cashier)
    {
        //
    }

}
