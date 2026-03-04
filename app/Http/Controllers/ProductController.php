<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of all products
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        return view('products.form');
    }

    /**
     * Store a newly created product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_code' => 'required|unique:products|string|max:255',
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
        ]);

        Product::create($validated);

        return redirect('/products')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product with suppliers
     */
    public function show(Product $product)
    {
        $product->load('suppliers');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the product
     */
    public function edit(Product $product)
    {
        return view('products.form', compact('product'));
    }

    /**
     * Update the specified product
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_code' => 'required|unique:products,product_code,' . $product->id . '|string|max:255',
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
        ]);

        $product->update($validated);

        return redirect("/products/{$product->id}")->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->with('success', 'Product deleted successfully!');
    }
}