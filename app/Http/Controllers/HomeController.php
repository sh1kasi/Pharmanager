<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request) {

        $total_product = Product::count();
        $total_customer = Customer::count();
        $total_supplier = Supplier::count();

        
        $products = Product::where('stock', 0)->get();

        return view('home', compact('products', 'total_product', 'total_customer', 'total_supplier'));
    }
}
