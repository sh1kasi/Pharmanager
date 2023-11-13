<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use PDF;
// use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Product;
use App\Models\Order_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function invoice_index($id) {

        $order = Order::find($id);
        $oDetail = $order->order_details()->get();
        return view('order.invoice', compact('order', 'oDetail'));
    }
    
    public function print_invoice($id) {

        $order = Order::find($id);
        $oDetail = $order->order_details()->get();
        return view('order.print_invoice', compact('order', 'oDetail'));
    }

    public function log_index() {
        $orders = Order::get();
        return view('order.log_transaction', compact('orders'));
    }

    public function pdf_invoice($id) {
        $order = Order::find($id);
        $oDetail = $order->order_details()->get();
        
        view()->share([
            'order' => $order,
            'oDetail' => $oDetail,
        ]);
        
        $pdf = PDF::loadview('pdf.invoice_pdf');
        // dd($pdf);
        // return view('pdf.invoice_pdf');
        return $pdf->stream();
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
        // dd($request->nominal);
        $request->validate([
            'customer_id' => 'required|numeric',
            'nominals' => 'required|min: ' . intval(str_replace('.', '', Cart::total())) . '|numeric',
        ],[
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute wajib berupa angka!',
            'min' => 'uang kurang!',
        ]);
        
        // dd("tembus");
        // Pembuatan Order
        $order = new Order;
        $order->customer_id = $request->customer_id;
        $order->order_date = Carbon::now();
        $order->total_products = Cart::count();
        $order->total = intval(str_replace('.', '', Cart::total()));

        $order->save();


        $contents = Cart::content();
        foreach ($contents as $content) {
            $order_detail = new Order_Detail;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $content->id;
            $order_detail->quantity =  $content->qty;
            $order_detail->unit_price = $content->price;
            $order_detail->total_price = $content->price * $content->qty;
            $order_detail->save();

            $product = Product::where('id', $content->id)->first();
            $product->stock -= $content->qty;
            $product->save();
        }

        Cart::destroy();

        return redirect()->route('order.invoice.index', $order->id);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
