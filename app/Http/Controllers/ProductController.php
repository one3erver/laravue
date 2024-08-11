<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    //For showing all products in the page
    public function index(){
        $products = Product::all();
        return Inertia::render('Products/index', ['products' => $products]);
    }

    //For Showing a product with a specific ID
    public function show($id){
        $product = Product::findOrFail($id);
        return Inertia::render('Products/show', ['product' => $product]);
    }
}
