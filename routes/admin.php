<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
   Route::get('/', function () {
       return "admin index";
   })->name('admin.dashboard');

   Route::resource('products', ProductController::class)->names('admin.products');
});
