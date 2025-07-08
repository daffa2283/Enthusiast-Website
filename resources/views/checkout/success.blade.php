@extends('layouts.app')

@section('title', 'Order Successful - EnthusiastVerse')

@push('styles')
<style>
.success-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.success-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.success-card {
    background: white;
    border-radius: 16px;
    padding: 3rem 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #10B981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: successPulse 2s ease-in-out infinite;
}

@keyframes successPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.success-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.order-details {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: left;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e9ecef;
}

.order-number {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
}

.order-status {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.customer-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.info-group {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #10B981;
}

.info-label {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.25rem;
}

.info-value {
    font-weight: 600;
    color: #1a1a1a;
}

.order-items {
    margin-bottom: 2rem;
}

.items-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.order-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-1px);
}

.order-item:last-child {
    margin-bottom: 0;
}

.item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    margin-right: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    flex-shrink: 0;
}

.item-details {
    flex: 1;
    min-width: 0;
}

.item-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 1rem;
    line-height: 1.4;
}

.item-quantity {
    color: #666;
    font-size: 0.9rem;
    background: #f8f9fa;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    display: inline-block;
    font-weight: 500;
}

.item-price {
    font-weight: 700;
    color: #1a1a1a;
    font-size: 1.1rem;
    text-align: right;
    flex-shrink: 0;
    margin-left: 1rem;
}

.item-unit-price {
    font-size: 0.8rem;
    color: #666;
    font-weight: 400;
    display: block;
    margin-top: 0.25rem;
}

.order-totals {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 2rem;
    border-radius: 12px;
    border: 2px solid #10B981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
}

.totals-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(16, 185, 129, 0.1);
}

.total-row:last-child {
    border-bottom: none;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 2px solid #10B981;
    background: white;
    margin: 1rem -2rem -2rem;
    padding: 1.5rem 2rem;
    border-radius: 0 0 12px 12px;
}

.total-label {
    color: #666;
    font-weight: 500;
    font-size: 0.95rem;
}

.total-value {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.95rem;
}

.grand-total {
    font-size: 1.3rem;
    font-weight: 700;
    color: #10B981;
}

.grand-total-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
    color: white;
}

.btn-secondary {
    background: white;
    color: #1a1a1a;
    border: 2px solid #1a1a1a;
}

.btn-secondary:hover {
    background: #1a1a1a;
    color: white;
}

.payment-info {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 2rem;
    text-align: left;
}

.payment-title {
    font-weight: 600;
    color: #856404;
    margin-bottom: 0.5rem;
}

.payment-text {
    color: #856404;
    font-size: 0.9rem;
    line-height: 1.5;
}

.track-info {
    background: #e7f3ff;
    border: 1px solid #b3d9ff;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
    text-align: left;
}

.track-title {
    font-weight: 600;
    color: #0066cc;
    margin-bottom: 0.5rem;
}

.track-text {
    color: #0066cc;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .success-card {
        padding: 2rem 1rem;
    }
    
    .success-title {
        font-size: 2rem;
    }
    
    .order-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .customer-info {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .order-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 1rem;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 0.5rem;
        width: 100px;
        height: 100px;
    }
    
    .item-details {
        text-align: center;
        margin-bottom: 0.5rem;
    }
    
    .item-price {
        margin-left: 0;
        text-align: center;
    }
    
    .items-title {
        font-size: 1.1rem;
    }
}
</style>
@endpush

@section('content')
<section class="success-container">
    <div class="success-wrapper">
        <div class="success-card">
            <div class="success-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
            
            <h1 class="success-title">Order Successful!</h1>
            <p class="success-subtitle">
                Thank you for your purchase! Your order has been placed successfully and we'll send you a confirmation email shortly.
            </p>
            
            <div class="order-details">
                <div class="order-header">
                    <div class="order-number">
                        Order #{{ $order->order_number }}
                    </div>
                    <div class="order-status">
                        {{ ucfirst($order->status) }}
                    </div>
                </div>
                
                <div class="customer-info">
                    <div class="info-group">
                        <div class="info-label">Customer Name</div>
                        <div class="info-value">{{ $order->customer_name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $order->customer_email }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $order->customer_phone }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Payment Method</div>
                        <div class="info-value">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</div>
                    </div>
                </div>
                
                <div class="order-items">
                    <div class="items-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 0.5rem; vertical-align: middle;">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                        </svg>
                        Order Items ({{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }})
                    </div>
                    @foreach($order->orderItems as $item)
                        <div class="order-item">
<<<<<<< HEAD
                            <img src="{{ asset($item->product->image ?? 'images/MOCKUP DEPAN.jpeg.jpg') }}" 
=======
                            <img src="{{ asset('storage/' .$item->product->image ?? 'images/MOCKUP DEPAN.jpeg.jpg') }}" 
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
                                 alt="{{ $item->product_name }}" 
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="item-price">
                                Rp. {{ number_format($item->total, 0, ',', '.') }}
                                <span class="item-unit-price">
                                    @ Rp. {{ number_format($item->product_price, 0, ',', '.') }} each
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="order-totals">
                    <div class="totals-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Order Summary
                    </div>
                    <div class="total-row">
                        <span class="total-label">Subtotal</span>
                        <span class="total-value">{{ $order->formatted_subtotal }}</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Shipping Cost</span>
                        <span class="total-value">
                            @if($order->shipping_cost == 0)
                                <span style="color: #10B981; font-weight: 600;">FREE</span>
                            @else
                                {{ $order->formatted_shipping_cost }}
                            @endif
                        </span>
                    </div>
                    <div class="total-row">
                        <span class="grand-total-label">Total Amount</span>
                        <span class="grand-total">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
            
=======

            <div class="wa-confirm-card" style="background: #e7fbe9; border: 2px solid #25D366; border-radius: 12px; padding: 2rem; margin: 2rem 0; text-align: center;">
                <div style="font-size: 1.2rem; font-weight: 600; color: #128C7E; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                    </svg>
                    Konfirmasi Pesanan via WhatsApp
                </div>
                <div style="color: #128C7E; font-size: 1rem; margin-bottom: 1.5rem;">
                    Konfirmasi pesanan Anda melalui WhatsApp untuk mempercepat proses pengiriman.<br>
                    Klik tombol di bawah ini untuk chat admin dan sebutkan nomor order Anda.<br>
                    <b>Order #{{ $order->order_number }}</b>
                </div>
                <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20sudah%20melakukan%20order%20dengan%20nomor%20{{ $order->order_number }}" target="_blank" class="btn" style="background: linear-gradient(135deg, #25D366, #128C7E); color: white;">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                    </svg>
                    Konfirmasi via WhatsApp
                </a>
            </div>

>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
            @if($order->payment_method === 'bank_transfer')
                <div class="payment-info">
                    <div class="payment-title">💳 Payment Instructions</div>
                    <div class="payment-text">
                        Please transfer the total amount to our bank account:<br>
                        <strong>Bank:</strong> BCA<br>
                        <strong>Account Number:</strong> 1234567890<br>
                        <strong>Account Name:</strong> EnthusiastVerse<br>
                        <strong>Amount:</strong> {{ $order->formatted_total }}
                    </div>
                </div>
            @elseif($order->payment_method === 'cod')
                <div class="payment-info">
                    <div class="payment-title">💰 Cash on Delivery</div>
                    <div class="payment-text">
                        Please prepare the exact amount of {{ $order->formatted_total }} when your order arrives.
                    </div>
                </div>
            @endif
            
            <div class="track-info">
                <div class="track-title">📦 Order Tracking</div>
                <div class="track-text">
                    You can track your order status using order number <strong>{{ $order->order_number }}</strong> on our tracking page.
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('checkout.track') }}?order_number={{ $order->order_number }}" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Track Order
                </a>
                <a href="{{ route('products') }}" class="btn btn-secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                    </svg>
                    Continue Shopping
                </a>
<<<<<<< HEAD
=======
                <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20sudah%20melakukan%20order%20dengan%20nomor%20{{ $order->order_number }}" target="_blank" class="btn" style="background: linear-gradient(135deg, #25D366, #128C7E); color: white;">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                    </svg>
                    WhatsApp
                </a>
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
            </div>
        </div>
    </div>
</section>
@endsection