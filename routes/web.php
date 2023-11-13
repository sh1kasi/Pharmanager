<?php

use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login Session
Route::get('/', [AuthController::class, 'login_index'])->name('login.index');
Route::post('/login', [AuthController::class, 'login_store'])->name('login.store');

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Register Session
Route::get('/register', [AuthController::class, 'register_index'])->name('register.index');
Route::post('/register', [AuthController::class, 'register_store'])->name('register.store');

Route::middleware('auth')->group(function () {  
    Route::get('/home', [HomeController::class, 'index'])->name('index');

    Route::resource('/customer', CustomerController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/cashier', CashierController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/penjualan', SaleController::class);

    // Supplier Detail
    Route::prefix('/supplier/detail')->name('supplier.detail.')->group(function () {
        Route::get('{supplier}', [SupplierDetailController::class, 'index'])->name('index');
        Route::get('/create/{supplier}', [SupplierDetailController::class, 'create'])->name('create');
        Route::post('{supplier}', [SupplierDetailController::class, 'store'])->name('store');
        Route::get('{supplier_id}/edit/{id}', [SupplierDetailController::class, 'edit'])->name('edit');
        Route::put('{supplier_id}/update/{id}', [SupplierDetailController::class, 'update'])->name('update');
        Route::delete('{supplier}', [SupplierDetailController::class, 'destroy'])->name('destroy');
    });

    // Cashier
    Route::post('/cashier/cart/add', [CashierController::class, 'addCartItem'])->name('cashier.addCartItem');
    Route::delete('/cashier/cart/remove/{rowId}', [CashierController::class, 'removeCartItem'])->name('cashier.removeCartItem');
    Route::post('/cashier/cart/update/{rowId}', [CashierController::class, 'updateCartItem'])->name('cashier.updateCartItem');

    // Order
    Route::get('/order/{id}/invoice', [OrderController::class, 'invoice_index'])->name('order.invoice.index');
    Route::get('/order/{id}/invoice/print', [OrderController::class, 'print_invoice'])->name('order.invoice.print');
    Route::get('/order/{id}/invoice/pdf', [OrderController::class, 'pdf_invoice'])->name('order.invoice.pdf');

    Route::get('/transaksi', [OrderController::class, 'log_index'])->name('order.log.index');

    // Sale
    Route::post('/penjualan/date-range', [SaleController::class, 'findDateRange'])->name('sale.findDateRange');

});