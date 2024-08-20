<?php


use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::resource('carts', CartController::class)->names('carts')
        ->only('index', 'store', 'update', 'destroy');
    Route::resource('orders', OrderController::class)->names('orders')
        ->only('index', 'store', 'update');
    Route::resource('invoices', InvoiceController::class)->names('invoices')
        ->only('store', 'update', 'destroy', 'show');
});

Route::get('/test', function (){
    return view('test');
});
