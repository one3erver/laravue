<?php


use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::resource('carts', CartController::class)->names('carts')
        ->only('index', 'store', 'update', 'destroy');
    Route::resource('orders', OrderController::class)->names('orders');
});

Route::get('/test', function (){
    return view('customer.test');
});
