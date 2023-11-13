<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier_Detail;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $order = Order::orderBy('order_date', 'ASC')->get();
        $supplier_detail = Supplier_Detail::get();
        $total_expenses = 0;
        foreach ($supplier_detail as $value) {
            $total_expenses += $value->quantity * $value->price_unit;
        }
        
        $chartItems = array();
        foreach ($order as $key => $value) {
            $date = Carbon::parse($value->order_date)->format('Y-m-d');

            $chartItems[$key] = [
                'date' => Carbon::parse($value->order_date)->format('d/m/Y'),
                'total_products' => Order::whereDate('order_date', $date)->sum('total_products'),
                'total' => Order::whereDate('order_date', $date)->sum('total'),
            ];
        };

        // dd($chartItems);


        return view('sale.index', [
            'chartItems' => $chartItems,
            'order' => $order,
            'total_expenses' => $total_expenses,
        ]);
    }

    public function findDateRange(Request $request) {
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        $order = Order::orderBy('order_date', 'ASC')->whereBetween('order_date', [$from, $to])->get();

        $chartItems = array();
        foreach ($order as $key => $value) {
            $date = Carbon::parse($value->order_date)->format('Y-m-d');

            $chartItems[$key] = [
                'date' => Carbon::parse($value->order_date)->format('d/m/Y'),
                'total_products' => Order::whereDate('order_date', $date)->sum('total_products'),
                'total' => Order::whereDate('order_date', $date)->sum('total'),
            ];
        };

        return response()->json([
            'chartItems' => $chartItems,    
        ]);



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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
