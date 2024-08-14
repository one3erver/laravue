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
   Route::resource('orders', OrderController::class)->names('admin.orders')->only(['index', 'show', 'destroy']);
   Route::resource('users', UserController::class)->names('admin.users')->only(['index', 'show', 'edit', 'update']);
   Route::resource('settings', SettingController::class)->names('admin.settings')->except(['show', 'destroy']);
});
