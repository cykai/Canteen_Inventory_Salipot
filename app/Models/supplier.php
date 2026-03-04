<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'contact_email',
        'contact_number',
    ];

    /**
     * Get all products supplied by this supplier
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'stock_entries')
                    ->withPivot('quantity', 'delivery_reference')
                    ->withTimestamps();
    }

    /**
     * Get all stock entries for this supplier
     */
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }
}