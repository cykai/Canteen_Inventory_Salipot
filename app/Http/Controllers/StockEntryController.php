<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class StockEntryController extends Controller
{
  
    public function index(Request $request)
    {
        $query = StockEntry::with('product', 'supplier');

       
        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

      
        if ($request->has('supplier_id') && $request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $stockEntries = $query->orderByDesc('created_at')->paginate(15);
        $allProducts = Product::all();
        $allSuppliers = Supplier::all();

        return view('stock_entries.index', compact('stockEntries', 'allProducts', 'allSuppliers'));
    }

  
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('stock_entries.create', compact('products', 'suppliers'));
    }

 
    public function store(Request $request)
    {

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'delivery_reference' => 'required|unique:stock_entries|string|max:255',
        ], [
            'delivery_reference.unique' => 'This delivery reference already exists. Please use a unique reference.',
            'quantity.min' => 'Quantity must be greater than zero.',
        ]);


        $stockEntry = StockEntry::create($validated);


        $product = Product::findOrFail($validated['product_id']);
        $product->increment('current_stock', $validated['quantity']);

        return redirect('/stock-entries')->with('success', 'Stock entry recorded successfully! Product stock updated.');
    }

 
    public function destroy(StockEntry $stockEntry)
    {
        $product = $stockEntry->product;
        $quantity = $stockEntry->quantity;

    
        $stockEntry->delete();

      
        $product->decrement('current_stock', $quantity);

        return redirect('/stock-entries')->with('success', 'Stock entry deleted and product stock reduced.');
    }
}