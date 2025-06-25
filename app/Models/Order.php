<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Auto generate order number when creating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ENT-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Get formatted total
    public function getFormattedTotalAttribute()
    {
        return 'Rp. ' . number_format($this->total, 0, ',', '.');
    }

    // Get formatted subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp. ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Get formatted shipping cost
    public function getFormattedShippingCostAttribute()
    {
        return 'Rp. ' . number_format($this->shipping_cost, 0, ',', '.');
    }

    // Scope for pending orders
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for completed orders
    public function scopeCompleted($query)
    {
        return $query->where('status', 'delivered');
    }
}