<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of all suppliers
     */
    public function index()
    {
        $suppliers = Supplier::paginate(12);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier
     */
    public function create()
    {
        return view('suppliers.form');
    }

    /**
     * Store a newly created supplier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_code' => 'required|unique:suppliers|string|max:255',
            'supplier_name' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:suppliers',
            'contact_number' => 'required|string|max:20',
        ]);

        Supplier::create($validated);

        return redirect('/suppliers')->with('success', 'Supplier created successfully!');
    }

    /**
     * Display the specified supplier with products
     */
    public function show(Supplier $supplier)
    {
        $supplier->load('products');
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the supplier
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.form', compact('supplier'));
    }

    /**
     * Update the specified supplier
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supplier_code' => 'required|unique:suppliers,supplier_code,' . $supplier->id . '|string|max:255',
            'supplier_name' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:suppliers,contact_email,' . $supplier->id,
            'contact_number' => 'required|string|max:20',
        ]);

        $supplier->update($validated);

        return redirect("/suppliers/{$supplier->id}")->with('success', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified supplier
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect('/suppliers')->with('success', 'Supplier deleted successfully!');
    }
}