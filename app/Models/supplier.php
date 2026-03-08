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

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'stock_entries')
                    ->withPivot('quantity', 'delivery_reference')
                    ->withTimestamps();
    }

   
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }
}