<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
   Route::get('/', function () {
       return view('admin.index');
   })->name('admin.dashboard');

   Route::resource('products', ProductController::class)->names('admin.products');
   Route::delete('/orders/delete-unpaid', [OrderController::class, 'deleteUnpaid'])->name('admin.orders.delete-unpaid');
   Route::resource('orders', OrderController::class)->names('admin.orders')->only(['index', 'destroy','show']);
   Route::resource('users', UserController::class)->names('admin.users')->only(['index', 'show', 'edit', 'update']);
   Route::resource('settings', SettingController::class)->names('admin.settings')->except(['show', 'destroy']);
   Route::get('/logout', function () {
        return view('admin.logout');
    })->name('admin.logout');

});
