<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'price',
        'current_stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'current_stock' => 'integer',
    ];

    
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'stock_entries')
                    ->withPivot('quantity', 'delivery_reference')
                    ->withTimestamps();
    }

 
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }
}