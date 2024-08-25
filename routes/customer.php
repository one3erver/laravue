<?php


use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
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

    Route::get('checkouts', [CheckoutController::class, 'show'])->name('checkouts.show');
    Route::post('unpaid', [CheckoutController::class, 'unpaid'])->name('checkouts.unpaid');
    Route::post('checkouts', [CheckoutController::class, 'checkoutValidate'])->name('checkouts.validate');
    Route::get('checkouts/successful', [CheckoutController::class, 'success'])->name('checkouts.success')
        ->middleware('check.payment');
});

Route::get('/test', function (){
    return view('test');
});
