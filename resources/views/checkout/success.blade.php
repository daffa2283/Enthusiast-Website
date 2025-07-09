@extends('layouts.app')

@section('title', 'Order Status - EnthusiastVerse')

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

.pending-icon {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
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

.payment-confirmation-card {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #fbbf24;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.payment-confirmation-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #856404;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.payment-confirmation-text {
    color: #856404;
    font-size: 1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.payment-steps {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    text-align: left;
}

.payment-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding: 0.5rem 0;
}

.payment-step:last-child {
    margin-bottom: 0;
}

.step-number {
    background: #fbbf24;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-text {
    color: #856404;
    font-size: 0.9rem;
    line-height: 1.4;
}

.confirm-payment-btn {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    margin-top: 1rem;
}

.confirm-payment-btn:hover {
    background: linear-gradient(135deg, #059669, #10B981);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    color: white;
}

.confirm-payment-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
}

.confirm-payment-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
}

.confirm-payment-btn.disabled:hover {
    background: linear-gradient(135deg, #9CA3AF, #6B7280) !important;
    transform: none !important;
    box-shadow: none !important;
}

.payment-proof-status {
    background: #f3f4f6;
    border: 2px solid #d1d5db;
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    text-align: center;
    transition: all 0.3s ease;
}

.payment-proof-status.sent {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border-color: #10b981;
}

.proof-status-icon {
    width: 48px;
    height: 48px;
    margin: 0 auto 1rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e5e7eb;
    transition: all 0.3s ease;
}

.proof-status-icon.sent {
    background: #10b981;
}

.proof-status-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #6b7280;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.proof-status-title.sent {
    color: #065f46;
}

.proof-status-text {
    font-size: 0.9rem;
    color: #9ca3af;
    transition: all 0.3s ease;
}

.proof-status-text.sent {
    color: #047857;
}

.countdown-timer {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.5rem;
    font-weight: 500;
}

.countdown-timer.active {
    color: #10b981;
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

.copy-btn:active {
    transform: translateY(0);
}

.copy-btn.copied {
    background: linear-gradient(135deg, #10B981, #059669);
    animation: copySuccess 0.3s ease;
}

@keyframes copySuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
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

.copy-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid transparent;
    border-top-color: #1a1a1a;
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
}

.status-pending {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-paid {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
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

.btn-whatsapp {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
}

.btn-whatsapp:hover {
    background: linear-gradient(135deg, #128C7E, #25D366);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
    color: white;
}

.wa-confirm-card {
    background: #e7fbe9;
    border: 2px solid #25D366;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
    text-align: center;
}

.wa-confirm-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #128C7E;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.wa-confirm-text {
    color: #128C7E;
    font-size: 1rem;
    margin-bottom: 1.5rem;
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
    margin-left: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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
            <div class="success-icon {{ $order->payment_status === 'pending' ? 'pending-icon' : '' }}">
                @if($order->payment_status === 'pending')
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                @else
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                @endif
            </div>
            
            @if($order->payment_status === 'pending')
                <h1 class="success-title">Order Successfully Created!</h1>
                <p class="success-subtitle">
                    Thank you for your order! Please confirm your payment via WhatsApp and send a photo of your payment proof to process your order.
                </p>
                
                <div class="payment-confirmation-card">
                    <div class="payment-confirmation-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        Payment Confirmation Required
                    </div>
                    <div class="payment-confirmation-text">
                        To process your order, please follow these steps:
                    </div>
                    
                    <div class="payment-steps">
                        <div class="payment-step">
                            <div class="step-number">1</div>
                            <div class="step-text">Make payment according to your selected payment method</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">2</div>
                            <div class="step-text">Take a photo/screenshot of your payment proof</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">3</div>
                            <div class="step-text">Send payment proof via WhatsApp with your order number</div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">4</div>
                            <div class="step-text">Click "Payment Confirmed" button after sending the proof</div>
                        </div>
                    </div>
                    
                    <a href="https://wa.me/6287843997805?text=Hello%2C%20I%20have%20made%20payment%20for%20order%20{{ $order->order_number }}%20and%20will%20send%20payment%20proof" target="_blank" class="btn btn-whatsapp" id="whatsappBtn" onclick="markProofSent()">
                        <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                            <path d="M16 3C9.373 3 4 8.373 4 15c0 2.637.844 5.086 2.438 7.188L4 29l7.031-2.375C13.086 27.156 14.52 27.5 16 27.5c6.627 0 12-5.373 12-12S22.627 3 16 3zm0 22c-1.313 0-2.594-.219-3.813-.656l-.273-.094-4.188 1.406 1.406-4.094-.094-.281C6.844 19.094 6 17.094 6 15c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10zm5.406-7.594c-.297-.148-1.758-.867-2.031-.969-.273-.102-.469-.148-.664.148-.195.297-.758.969-.93 1.164-.172.195-.344.219-.641.07-.297-.148-1.258-.463-2.398-1.477-.887-.789-1.484-1.766-1.656-2.062-.172-.297-.018-.457.13-.605.133-.133.297-.344.445-.516.148-.172.195-.297.297-.492.102-.195.051-.367-.025-.516-.078-.148-.664-1.602-.91-2.195-.24-.578-.484-.5-.664-.508-.172-.008-.367-.01-.562-.01-.195 0-.516.074-.789.367-.273.297-1.04 1.016-1.04 2.477 0 1.461 1.065 2.875 1.213 3.07.148.195 2.098 3.203 5.086 4.367.711.305 1.266.488 1.699.625.715.227 1.367.195 1.883.117.574-.086 1.758-.719 2.008-1.414.25-.695.25-1.289.176-1.414-.074-.125-.27-.195-.566-.344z"/>
                        </svg>
                        Send Payment Proof
                    </a>
                    
                    <!-- Payment Proof Status -->
                    <div id="paymentProofStatus" class="payment-proof-status">
                        <div class="proof-status-icon" id="proofStatusIcon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="#9ca3af">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="proof-status-title" id="proofStatusTitle">Payment Proof Not Sent</div>
                        <div class="proof-status-text" id="proofStatusText">Please send payment proof via WhatsApp first</div>
                        <div class="countdown-timer" id="countdownTimer" style="display: none;"></div>
                    </div>
                    
                    <button id="confirmPaymentBtn" class="confirm-payment-btn disabled" disabled onclick="confirmPayment({{ $order->id }})">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        Payment Confirmed
                    </button>
                </div>
            @else
                <h1 class="success-title">Order Confirmed!</h1>
                <p class="success-subtitle">
                    Your payment has been confirmed! Your order is being processed and will be shipped soon.
                </p>
            @endif
            
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
                    <div class="order-status {{ $order->payment_status === 'pending' ? 'status-pending' : 'status-paid' }}">
                        {{ $order->payment_status === 'pending' ? 'Awaiting Payment' : 'Payment Confirmed' }}
                    </div>
                </div>
                
                {{-- Customer info hidden as requested --}}
                
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
// Global variables
let countdownInterval;
let proofSentTime = null;

// Check if proof was already sent (from localStorage)
document.addEventListener('DOMContentLoaded', function() {
    const orderId = {{ $order->id }};
    const savedProofTime = localStorage.getItem(`proof_sent_${orderId}`);
    
    if (savedProofTime) {
        const sentTime = new Date(savedProofTime);
        const now = new Date();
        const timeDiff = now - sentTime;
        
        // If less than 5 minutes have passed, consider proof as sent
        if (timeDiff < 5 * 60 * 1000) {
            markProofAsSent(sentTime);
        } else {
            // Clear old data
            localStorage.removeItem(`proof_sent_${orderId}`);
        }
    }
});

// Function to mark proof as sent when WhatsApp button is clicked
function markProofSent() {
    const orderId = {{ $order->id }};
    const now = new Date();
    
    // Save to localStorage
    localStorage.setItem(`proof_sent_${orderId}`, now.toISOString());
    
    // Start countdown after a short delay (to allow WhatsApp to open)
    setTimeout(() => {
        markProofAsSent(now);
        showToast('info', 'WhatsApp Opened!', 'Please send your payment proof. Confirmation button will be active in 30 seconds.');
    }, 2000);
}

// Function to update UI when proof is marked as sent
function markProofAsSent(sentTime) {
    proofSentTime = sentTime;
    
    // Update status display
    const statusContainer = document.getElementById('paymentProofStatus');
    const statusIcon = document.getElementById('proofStatusIcon');
    const statusTitle = document.getElementById('proofStatusTitle');
    const statusText = document.getElementById('proofStatusText');
    const countdownTimer = document.getElementById('countdownTimer');
    
    statusContainer.classList.add('sent');
    statusIcon.classList.add('sent');
    statusTitle.classList.add('sent');
    statusText.classList.add('sent');
    
    statusIcon.innerHTML = `
        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
        </svg>
    `;
    statusTitle.textContent = 'Payment Proof Sent';
    statusText.textContent = 'Waiting for confirmation time...';
    
    // Show countdown
    countdownTimer.style.display = 'block';
    countdownTimer.classList.add('active');
    
    // Start countdown (30 seconds)
    startCountdown(30);
}

// Function to start countdown
function startCountdown(seconds) {
    let timeLeft = seconds;
    const countdownTimer = document.getElementById('countdownTimer');
    
    countdownInterval = setInterval(() => {
        countdownTimer.textContent = `Confirmation button will be active in ${timeLeft} seconds`;
        timeLeft--;
        
        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            enableConfirmButton();
        }
    }, 1000);
}

// Function to enable confirm button
function enableConfirmButton() {
    const confirmBtn = document.getElementById('confirmPaymentBtn');
    const countdownTimer = document.getElementById('countdownTimer');
    const statusText = document.getElementById('proofStatusText');
    
    // Enable button
    confirmBtn.disabled = false;
    confirmBtn.classList.remove('disabled');
    
    // Update status
    statusText.textContent = 'Please click the payment confirmation button below';
    countdownTimer.textContent = 'Confirmation button is now active!';
    countdownTimer.style.color = '#10b981';
    
    // Show success toast
    showToast('success', 'Button Active!', 'You can now confirm your payment.');
}

function confirmPayment(orderId) {
    const btn = document.getElementById('confirmPaymentBtn');
    
    // Check if button is disabled
    if (btn.disabled || btn.classList.contains('disabled')) {
        showToast('warning', 'Please Wait!', 'Please send payment proof via WhatsApp first.');
        return;
    }
    
    // Add loading state
    btn.classList.add('loading');
    btn.disabled = true;
    btn.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
        Processing...
    `;
    
    // Send AJAX request to confirm payment
    fetch(`/checkout/confirm-payment/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear localStorage
            localStorage.removeItem(`proof_sent_${orderId}`);
            
            // Show success message
            showToast('success', 'Payment Confirmed!', 'Order status has been changed to confirmed.');
            
            // Reload page after 2 seconds to show updated status
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            // Show error message
            showToast('error', 'Failed!', data.message || 'An error occurred while confirming payment.');
            
            // Reset button
            btn.classList.remove('loading');
            btn.disabled = false;
            btn.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                </svg>
                Payment Confirmed
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error!', 'A network error occurred. Please try again.');
        
        // Reset button
        btn.classList.remove('loading');
        btn.disabled = false;
        btn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
            Payment Confirmed
        `;
    });
}

// Function to copy order number
function copyOrderNumber(orderNumber) {
    // Extract only the part after "#"
    const orderNumberOnly = orderNumber;
    
    // Try to use the modern clipboard API
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(orderNumberOnly).then(() => {
            showCopySuccess();
        }).catch(() => {
            // Fallback to older method
            fallbackCopyTextToClipboard(orderNumberOnly);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(orderNumberOnly);
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
    
    // Add copied class for animation
    copyBtn.classList.add('copied');
    
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
        copyBtn.classList.remove('copied');
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