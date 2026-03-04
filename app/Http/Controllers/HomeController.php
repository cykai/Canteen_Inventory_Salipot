<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockEntry; 

class HomeController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalStockEntries = StockEntry::count();
        
        // Get low stock products (less than or equal to 10 units)
        $lowStockProducts = Product::where('current_stock', '<=', 10)
                                    ->orderBy('current_stock')
                                    ->get();
        $lowStockCount = $lowStockProducts->count();

        // Get recent stock entries
        $recentStockEntries = StockEntry::with('product', 'supplier')
                                        ->orderByDesc('created_at')
                                        ->limit(5)
                                        ->get();

        return view('home', compact(
            'totalProducts',
            'totalSuppliers',
            'totalStockEntries',
            'lowStockProducts',
            'lowStockCount',
            'recentStockEntries'
        ));
    }
}