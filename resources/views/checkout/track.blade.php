@extends('layouts.app')

@section('title', 'Track Order - EnthusiastVerse')

@push('styles')
<style>
.track-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.track-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.track-header {
    text-align: center;
    margin-bottom: 3rem;
}

.track-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.track-subtitle {
    color: #666;
    font-size: 1.1rem;
}

.track-form {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #FF3B3F;
    box-shadow: 0 0 0 3px rgba(255, 59, 63, 0.1);
}

.track-btn {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}

.track-btn:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
}

.order-result {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.order-number {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-processing {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.status-shipped {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.status-delivered {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.status-cancelled {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.order-timeline {
    margin: 2rem 0;
}

.timeline-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
    padding-left: 1rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #e9ecef;
    border: 3px solid white;
    box-shadow: 0 0 0 2px #e9ecef;
}

.timeline-item.active::before {
    background: #10b981;
    box-shadow: 0 0 0 2px #10b981;
}

.timeline-item.current::before {
    background: #3b82f6;
    box-shadow: 0 0 0 2px #3b82f6;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 2px #3b82f6; }
    50% { box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.3); }
    100% { box-shadow: 0 0 0 2px #3b82f6; }
}

.timeline-content {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #e9ecef;
}

.timeline-item.active .timeline-content {
    border-left-color: #10b981;
    background: #f0fdf4;
}

.timeline-item.current .timeline-content {
    border-left-color: #3b82f6;
    background: #eff6ff;
}

.timeline-status {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.25rem;
}

.timeline-description {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.timeline-date {
    color: #999;
    font-size: 0.8rem;
}

.info-card {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #10b981;
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

.error-message {
    background: #fee;
    color: #c33;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid #fcc;
    text-align: center;
}

.no-order {
    text-align: center;
    padding: 3rem 2rem;
}

.no-order-icon {
    width: 80px;
    height: 80px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: #999;
}

.no-order-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.no-order-text {
    color: #666;
    margin-bottom: 2rem;
}

.help-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-top: 2rem;
    text-align: center;
}

.help-title {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.help-text {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .track-title {
        font-size: 2rem;
    }
    
    .order-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .timeline {
        padding-left: 1.5rem;
    }
    
    .timeline::before {
        left: 10px;
    }
    
    .timeline-item::before {
        left: -18px;
    }
}
</style>
@endpush

@section('content')
<section class="track-container">
    <div class="track-wrapper">
        <div class="track-header">
            <h1 class="track-title">Track Your Order</h1>
            <p class="track-subtitle">Enter your order number to check the status</p>
        </div>
        
        <div class="track-form">
            <form action="{{ route('checkout.track') }}" method="GET">
                <div class="form-group">
                    <label for="order_number" class="form-label">Order Number</label>
                    <input type="text" 
                           id="order_number" 
                           name="order_number" 
                           class="form-input" 
                           placeholder="Enter your order number (e.g., ENT-20231220-0001)"
                           value="{{ request('order_number') }}"
                           required>
                </div>
                <button type="submit" class="track-btn">Track Order</button>
            </form>
        </div>
        
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        
        @if(isset($order))
            <div class="order-result">
                <div class="order-header">
                    <div class="order-number">Order #{{ $order->order_number }}</div>
                    <div class="order-status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </div>
                </div>
                
                <div class="order-timeline">
                    <div class="timeline-title">Order Timeline</div>
                    <div class="timeline">
                        <div class="timeline-item {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'active' : '' }}">
                            <div class="timeline-content">
                                <div class="timeline-status">Order Placed</div>
                                <div class="timeline-description">Your order has been received and is being processed</div>
                                <div class="timeline-date">{{ $order->created_at->format('M d, Y - H:i') }}</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'active' : '' }} {{ $order->status === 'processing' ? 'current' : '' }}">
                            <div class="timeline-content">
                                <div class="timeline-status">Processing</div>
                                <div class="timeline-description">Your order is being prepared for shipment</div>
                                @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                    <div class="timeline-date">{{ $order->updated_at->format('M d, Y - H:i') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : '' }} {{ $order->status === 'shipped' ? 'current' : '' }}">
                            <div class="timeline-content">
                                <div class="timeline-status">Shipped</div>
                                <div class="timeline-description">Your order has been shipped and is on the way</div>
                                @if(in_array($order->status, ['shipped', 'delivered']))
                                    <div class="timeline-date">{{ $order->updated_at->format('M d, Y - H:i') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="timeline-item {{ $order->status === 'delivered' ? 'active current' : '' }}">
                            <div class="timeline-content">
                                <div class="timeline-status">Delivered</div>
                                <div class="timeline-description">Your order has been successfully delivered</div>
                                @if($order->status === 'delivered')
                                    <div class="timeline-date">{{ $order->updated_at->format('M d, Y - H:i') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        @if($order->status === 'cancelled')
                            <div class="timeline-item active current">
                                <div class="timeline-content">
                                    <div class="timeline-status">Cancelled</div>
                                    <div class="timeline-description">Your order has been cancelled</div>
                                    <div class="timeline-date">{{ $order->updated_at->format('M d, Y - H:i') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if($order->notes)
                    <div class="info-card" style="margin-top: 1rem;">
                        <div class="info-label">Order Notes</div>
                        <div class="info-value">{{ $order->notes }}</div>
                    </div>
                @endif
            </div>
        @elseif(request('order_number'))
            <div class="order-result">
                <div class="no-order">
                    <div class="no-order-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    </div>
                    <div class="no-order-title">Order Not Found</div>
                    <div class="no-order-text">
                        We couldn't find an order with the number "{{ request('order_number') }}". 
                        Please check your order number and try again.
                    </div>
                </div>
            </div>
        @endif
        
        <div class="help-section">
            <div class="help-title">Need Help?</div>
            <div class="help-text">
                If you're having trouble tracking your order or have any questions, 
                please contact our customer support at <strong>support@enthusiasverse.com</strong> 
                or call us at <strong>+62 878-4399-7805</strong>.
            </div>
        </div>
    </div>
</section>
@endsection