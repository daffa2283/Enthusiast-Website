<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'back_image',
        'category',
        'stock',
        'is_active',
        'size',
        'color'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationship with cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for products in stock
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/MOCKUP DEPAN.jpeg.jpg');
    }

    // Tambahkan accessor untuk URL gambar belakang
    public function getBackImageUrlAttribute()
    {
        if ($this->back_image) {
            return asset('storage/' . $this->back_image);
        }
        return $this->image_url; // Gunakan gambar depan jika tidak ada gambar belakang
    }
}