<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

//Route::get('/panel_admin', function () {
//    return view('panel_admin.index');
//});
//Route::get('/panel_admin/add_product', function () {
//    return view('panel_admin.add_product');
//});
//Route::get('/panel_admin/update_product', function () {
//    return view('panel_admin.update_product');
//});
//Route::get('/panel_admin/orders', function () {
//    return view('panel_admin.orders');
//});
//Route::get('/panel_admin/users', function () {
//    return view('panel_admin.users');
//});
//Route::get('/panel_admin/update_user', function () {
//    return view('panel_admin.update_user');
//});
//Route::get('/panel_admin/setting', function () {
//    return view('panel_admin.setting');
//});
require __DIR__.'/auth.php';
require  __DIR__ . '/admin.php';
