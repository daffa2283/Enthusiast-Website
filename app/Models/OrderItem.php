<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'total',
        'size',
        'color'
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Relationship with order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Get formatted product price
    public function getFormattedProductPriceAttribute()
    {
        return 'Rp. ' . number_format($this->product_price, 0, ',', '.');
    }

    // Get formatted total
    public function getFormattedTotalAttribute()
    {
        return 'Rp. ' . number_format($this->total, 0, ',', '.');
    }
}