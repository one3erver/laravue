<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $image = uploadImage($request->image, 'products', 300, 300);
        Product::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => $image,
            'image_thumbnail' => $request->image_thumbnail,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            deleteImage('/admin/products/' . $product->image);
        }
        $image = uploadImage($request->image, 'products');

        $product->update([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => ($request->image ? $image : $product->image),
            'image_thumbnail' => $request->image_thumbnail,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        deleteImage('/admin/products/' . $product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
