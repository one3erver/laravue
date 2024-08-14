<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    //For showing all products in the page
    public function index(){
        $products = Product::all();
        return Inertia::render('Landing', compact('products'));
    }

    //For Showing a product with a specific ID
    public function show($id){
        $product = Product::findOrFail($id);
        return Inertia::render('Product', compact('product'));
    }
}
