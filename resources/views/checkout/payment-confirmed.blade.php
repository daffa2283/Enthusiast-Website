@extends('layouts.app')

@section('title', 'Payment Confirmed - EnthusiastVerse')

@push('styles')
<style>
.success-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
}

.success-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.success-card {
    background: white;
    border-radius: 16px;
    padding: 3rem 2rem;
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
    text-align: center;
    border: 2px solid #10b981;
}

.success-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #10B981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: successPulse 2s ease-in-out infinite;
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

@keyframes successPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.success-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: #065f46;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);
}

.success-subtitle {
    font-size: 1.2rem;
    color: #047857;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.confirmation-banner {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 2px solid #10b981;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
    animation: slideInFromTop 0.5s ease-out;
}

.banner-icon {
    width: 80px;
    height: 80px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    animation: bounceIn 0.6s ease-out;
}

.banner-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #065f46;
    margin-bottom: 1rem;
}

.banner-text {
    color: #047857;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.processing-timeline {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    border: 2px solid #10b981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
}

.timeline-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #065f46;
    margin-bottom: 1.5rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    position: relative;
    opacity: 1;
    transition: all 0.3s ease;
}

.timeline-step:last-child {
    margin-bottom: 0;
}

.timeline-step.active .step-icon {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    animation: pulse 2s infinite;
}

.timeline-step.completed .step-icon {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.step-content {
    flex: 1;
    padding-top: 0.5rem;
}

.step-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.step-description {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.4;
}

.timeline-step.active .step-title {
    color: #065f46;
}

.timeline-step.active .step-description {
    color: #047857;
}

.timeline-step.completed .step-title {
    color: #065f46;
}

.timeline-step.completed .step-description {
    color: #047857;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.order-details {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: left;
    border: 1px solid #e9ecef;
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
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.copy-btn {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    position: relative;
}

.copy-btn:hover {
    background: linear-gradient(135deg, #059669, #10B981);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.copy-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #1a1a1a;
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    margin-bottom: 0.5rem;
    z-index: 1000;
}

.copy-btn:hover .copy-tooltip {
    opacity: 1;
    visibility: visible;
}

.order-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
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

.item-attributes {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}

.attribute-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.2rem 0.6rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid;
}

.size-badge {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    color: #1565c0;
    border-color: #90caf9;
}

.color-badge {
    background: linear-gradient(135deg, #f3e5f5, #e1bee7);
    color: #7b1fa2;
    border-color: #ce93d8;
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
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #059669, #10B981);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

.btn-secondary {
    background: white;
    color: #10B981;
    border: 2px solid #10B981;
}

.btn-secondary:hover {
    background: #10B981;
    color: white;
}

@keyframes slideInFromTop {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .success-card {
        padding: 2rem 1rem;
    }
    
    .success-title {
        font-size: 2.2rem;
    }
    
    .order-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
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
}
</style>
@endpush

@section('content')
<section class="success-container">
    <div class="success-wrapper">
        <div class="success-card">
            <div class="success-icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="white">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
            </div>
            
            <h1 class="success-title">Payment Confirmed!</h1>
            <p class="success-subtitle">
                Excellent! Your payment has been verified and approved by our admin. Your order is now being processed and will be shipped soon.
            </p>
            
            <!-- Payment Confirmation Banner -->
            <div class="confirmation-banner">
                <div class="banner-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                </div>
                <div class="banner-title">Payment Successfully Verified</div>
                <div class="banner-text">
                    Your payment proof has been reviewed and approved by our admin team. 
                    We're now processing your order and will keep you updated on the shipping progress.
                </div>
            </div>
            
            <!-- Processing Timeline -->
            <div class="processing-timeline">
                <div class="timeline-title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    What Happens Next
                </div>
                
                <div class="timeline-step completed">
                    <div class="step-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <div class="step-content">
                        <div class="step-title">Payment Verified</div>
                        <div class="step-description">Your payment has been confirmed and approved</div>
                    </div>
                </div>
                
                <div class="timeline-step active">
                    <div class="step-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                    </div>
                    <div class="step-content">
                        <div class="step-title">Order Processing</div>
                        <div class="step-description">We're preparing your items for shipment</div>
                    </div>
                </div>
                
                <div class="timeline-step">
                    <div class="step-icon">
                        <span>3</span>
                    </div>
                    <div class="step-content">
                        <div class="step-title">Packaging & Quality Check</div>
                        <div class="step-description">Items will be carefully packaged and quality checked</div>
                    </div>
                </div>
                
                <div class="timeline-step">
                    <div class="step-icon">
                        <span>4</span>
                    </div>
                    <div class="step-content">
                        <div class="step-title">Shipment</div>
                        <div class="step-description">Your order will be shipped with tracking information</div>
                    </div>
                </div>
                
                <div class="timeline-step">
                    <div class="step-icon">
                        <span>5</span>
                    </div>
                    <div class="step-content">
                        <div class="step-title">Delivery</div>
                        <div class="step-description">Your order will be delivered to your address</div>
                    </div>
                </div>
            </div>
            
            <div class="order-details">
                <div class="order-header">
                    <div class="order-number">
                        Order #{{ $order->order_number }}
                        <button class="copy-btn" onclick="copyOrderNumber('{{ $order->order_number }}')" id="copyBtn">
                            <div class="copy-tooltip">Copy Order Number</div>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="order-status">
                        Payment Confirmed
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
                            <img src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : asset('images/MOCKUP DEPAN.jpeg.jpg') }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ $item->product_name }}</div>
                                @if($item->size || $item->color)
                                    <div class="item-attributes">
                                        @if($item->size)
                                            <span class="attribute-badge size-badge">Size: {{ $item->size }}</span>
                                        @endif
                                        @if($item->color)
                                            <span class="attribute-badge color-badge">Color: {{ $item->color }}</span>
                                        @endif
                                    </div>
                                @endif
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Function to copy order number
function copyOrderNumber(orderNumber) {
    // Try to use the modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(orderNumber).then(() => {
            showCopySuccess();
        }).catch(() => {
            // Fallback to older method
            fallbackCopyTextToClipboard(orderNumber);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(orderNumber);
    }
}

// Fallback copy function for older browsers
function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    textArea.style.opacity = "0";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showCopySuccess();
        } else {
            showToast('error', 'Copy Failed!', 'Unable to copy order number.');
        }
    } catch (err) {
        showToast('error', 'Copy Failed!', 'Unable to copy order number.');
    }
    
    document.body.removeChild(textArea);
}

// Function to show copy success feedback
function showCopySuccess() {
    const copyBtn = document.getElementById('copyBtn');
    const tooltip = copyBtn.querySelector('.copy-tooltip');
    
    // Change tooltip text temporarily
    const originalText = tooltip.textContent;
    tooltip.textContent = 'Copied!';
    
    // Change icon to checkmark temporarily
    const originalIcon = copyBtn.querySelector('svg').innerHTML;
    copyBtn.querySelector('svg').innerHTML = `
        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
    `;
    
    // Show success toast
    showToast('success', 'Copied!', 'Order number copied to clipboard.');
    
    // Reset after 2 seconds
    setTimeout(() => {
        tooltip.textContent = originalText;
        copyBtn.querySelector('svg').innerHTML = originalIcon;
    }, 2000);
}

// Toast notification function
function showToast(type, title, message) {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    let bgColor = '#10B981'; // success
    if (type === 'error') bgColor = '#EF4444';
    if (type === 'warning') bgColor = '#F59E0B';
    if (type === 'info') bgColor = '#3B82F6';
    
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${bgColor};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        z-index: 10000;
        transform: translateX(400px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: 350px;
    `;
    
    toast.innerHTML = `
        <div style="font-weight: 600; margin-bottom: 0.25rem;">${title}</div>
        <div style="font-size: 0.9rem; opacity: 0.9;">${message}</div>
    `;
    
    // Add to page
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto hide after 4 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(400px)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 4000);
}
</script>
@endpush