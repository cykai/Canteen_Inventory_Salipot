<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'delivery_reference',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the product for this stock entry
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the supplier for this stock entry
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}