<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
   Route::get('/', function () {
       return "admin index";
   })->name('admin.dashboard');


});
