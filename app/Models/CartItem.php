<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get total price for this cart item
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    // Get formatted total
    public function getFormattedTotalAttribute()
    {
        return 'Rp. ' . number_format($this->total, 0, ',', '.');
    }
}