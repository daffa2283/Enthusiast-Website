@extends('layouts.app')

@section('title', 'Checkout - EnthusiastVerse')

@push('styles')
<style>
.checkout-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.checkout-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.checkout-header {
    text-align: center;
    margin-bottom: 3rem;
}

.checkout-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    letter-spacing: 1px;
}

.checkout-subtitle {
    color: #666;
    font-size: 1.1rem;
}

.checkout-content {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 3rem;
    align-items: start;
}

.checkout-form {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 2rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0f0f0;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #fff;
}

.form-input:focus {
    outline: none;
    border-color: #FF3B3F;
    box-shadow: 0 0 0 3px rgba(255, 59, 63, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-select:focus {
    outline: none;
    border-color: #FF3B3F;
    box-shadow: 0 0 0 3px rgba(255, 59, 63, 0.1);
}

.payment-methods {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.payment-option {
    position: relative;
}

.payment-radio {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.payment-label {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.payment-radio:checked + .payment-label {
    border-color: #FF3B3F;
    background: rgba(255, 59, 63, 0.05);
}

.payment-icon {
    width: 24px;
    height: 24px;
    margin-right: 8px;
    flex-shrink: 0;
}

.payment-text {
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.order-summary {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    position: sticky;
    top: 120px;
}

.summary-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
    text-align: center;
}

.order-items {
    margin-bottom: 1.5rem;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 1rem;
}

.item-details {
    flex: 1;
}

.item-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.25rem;
    font-size: 14px;
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
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    color: #495057;
    padding: 0.2rem 0.6rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #dee2e6;
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
    font-size: 12px;
}

.item-price {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 14px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.summary-row:last-child {
    border-bottom: none;
    padding-top: 1rem;
    margin-top: 1rem;
    border-top: 2px solid #f0f0f0;
}

.summary-label {
    color: #666;
    font-weight: 500;
}

.summary-value {
    font-weight: 600;
    color: #1a1a1a;
}

.total-value {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
}

.free-shipping {
    color: #10B981;
    font-weight: 600;
}

.place-order-btn {
    width: 100%;
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
    border: none;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    margin-top: 1.5rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.place-order-btn:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
}

.place-order-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.error-message {
    background: #fee;
    color: #c33;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid #fcc;
}

.success-message {
    background: #efe;
    color: #363;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid #cfc;
}

.security-info {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1rem;
    border-left: 4px solid #10B981;
}

.security-title {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 14px;
}

.security-text {
    color: #666;
    font-size: 12px;
    line-height: 1.4;
}

/* Payment Details Styles */
.payment-details {
    margin-top: 1rem;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.payment-info-card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 1.5rem;
    border-left: 4px solid #FF3B3F;
}

.payment-info-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #dee2e6;
}

.payment-info-icon {
    width: 20px;
    height: 20px;
    color: #FF3B3F;
    margin-right: 8px;
    flex-shrink: 0;
}

.payment-info-header h4 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
}

.payment-info-content {
    margin-bottom: 1rem;
}

.account-detail {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.account-detail:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #666;
    font-size: 0.9rem;
    min-width: 120px;
}

.detail-value {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.9rem;
    flex: 1;
    text-align: right;
    margin-right: 0.5rem;
}

.account-number {
    font-family: 'Courier New', monospace;
    font-size: 1rem;
    letter-spacing: 1px;
    background: rgba(255, 59, 63, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    border: 1px solid rgba(255, 59, 63, 0.2);
}

.copy-btn {
    background: #FF3B3F;
    color: white;
    border: none;
    padding: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
}

.copy-btn:hover {
    background: #e63946;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 59, 63, 0.3);
}

.copy-btn:active {
    transform: translateY(0);
}

.payment-note {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
}

.payment-note p {
    margin: 0;
    font-size: 0.85rem;
    line-height: 1.4;
    color: #856404;
}

.payment-note strong {
    color: #533f03;
}

/* Copy success animation */
.copy-success {
    background: #28a745 !important;
    transform: scale(1.1);
}

.copy-success::after {
    content: '✓';
    position: absolute;
    font-size: 12px;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .checkout-form,
    .order-summary {
        padding: 1.5rem;
    }
    
    .payment-methods {
        grid-template-columns: 1fr;
    }
    
    .checkout-title {
        font-size: 2rem;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading .place-order-btn::after {
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
</style>
@endpush

@section('content')
<section class="checkout-container">
    <div class="checkout-wrapper">
        <div class="checkout-header">
            <h1 class="checkout-title">Checkout</h1>
            <p class="checkout-subtitle">Complete your order details below</p>
        </div>
        
        @if($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="checkout-content">
            <form action="{{ route('checkout.store') }}" method="POST" class="checkout-form" id="checkoutForm">
                @csrf
                
                <!-- Customer Information -->
                <div class="form-section">
                    <h3 class="section-title">Customer Information</h3>
                    
                    <div class="form-group">
                        <label for="customer_name" class="form-label">Full Name *</label>
                        <input type="text" 
                               id="customer_name" 
                               name="customer_name" 
                               class="form-input" 
                               value="{{ old('customer_name', auth()->user()->name ?? '') }}" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_email" class="form-label">Email Address *</label>
                        <input type="email" 
                               id="customer_email" 
                               name="customer_email" 
                               class="form-input" 
                               value="{{ old('customer_email', auth()->user()->email ?? '') }}" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_phone" class="form-label">Phone Number *</label>
                        <input type="tel" 
                               id="customer_phone" 
                               name="customer_phone" 
                               class="form-input" 
                               value="{{ old('customer_phone') }}" 
                               required>
                    </div>
                </div>
                
                <!-- Shipping Information -->
                <div class="form-section">
                    <h3 class="section-title">Shipping Information</h3>
                    
                    <div class="form-group">
                        <label for="shipping_address" class="form-label">Shipping Address *</label>
                        <textarea id="shipping_address" 
                                  name="shipping_address" 
                                  class="form-input form-textarea" 
                                  placeholder="Enter your complete shipping address..."
                                  required>{{ old('shipping_address') }}</textarea>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="form-section">
                    <h3 class="section-title">Payment Method</h3>
                    
                    <div class="payment-methods">
                        <div class="payment-option">
                            <input type="radio" 
                                   id="bank_transfer" 
                                   name="payment_method" 
                                   value="bank_transfer" 
                                   class="payment-radio"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                            <label for="bank_transfer" class="payment-label">
                                <svg class="payment-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2 6h20v2H2zm0 5h20v2H2zm0 5h20v2H2z"/>
                                </svg>
                                <span class="payment-text">Bank Transfer</span>
                            </label>
                        </div>
                        
                        <div class="payment-option">
                            <input type="radio" 
                                   id="e_wallet" 
                                   name="payment_method" 
                                   value="e_wallet" 
                                   class="payment-radio"
                                   {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }}>
                            <label for="e_wallet" class="payment-label">
                                <svg class="payment-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <span class="payment-text">E-Wallet</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Bank Transfer Details -->
                    <div id="bank_transfer_details" class="payment-details" style="display: none;">
                        <div class="payment-info-card">
                            <div class="payment-info-header">
                                <svg class="payment-info-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <h4>Transfer ke Rekening Berikut:</h4>
                            </div>
                            <div class="payment-info-content">
                                <div class="account-detail">
                                    <span class="detail-label">Bank:</span>
                                    <span class="detail-value">BCA</span>
                                </div>
                                <div class="account-detail">
                                    <span class="detail-label">Nama Rekening:</span>
                                    <span class="detail-value">MUHAMMAD DAFFA SHIDQI</span>
                                </div>
                                <div class="account-detail">
                                    <span class="detail-label">No. Rekening:</span>
                                    <span class="detail-value account-number">1672773096</span>
                                    <button type="button" class="copy-btn" onclick="copyToClipboard('1672773096')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="payment-note">
                                <p><strong>Catatan:</strong> Setelah melakukan transfer, mohon simpan bukti transfer dan kirimkan ke WhatsApp kami untuk konfirmasi pembayaran.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- E-Wallet Details -->
                    <div id="e_wallet_details" class="payment-details" style="display: none;">
                        <div class="payment-info-card">
                            <div class="payment-info-header">
                                <svg class="payment-info-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <h4>Transfer ke E-Wallet Berikut:</h4>
                            </div>
                            <div class="payment-info-content">
                                <div class="account-detail">
                                    <span class="detail-label">E-Wallet:</span>
                                    <span class="detail-value">DANA</span>
                                </div>
                                <div class="account-detail">
                                    <span class="detail-label">Nama Penerima:</span>
                                    <span class="detail-value">MUHAMMAD DAFFA SHIDQI</span>
                                </div>
                                <div class="account-detail">
                                    <span class="detail-label">No. DANA:</span>
                                    <span class="detail-value account-number">087843997805</span>
                                    <button type="button" class="copy-btn" onclick="copyToClipboard('087843997805')">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="payment-note">
                                <p><strong>Catatan:</strong> Setelah melakukan transfer via DANA, mohon simpan screenshot bukti transfer dan kirimkan ke WhatsApp kami untuk konfirmasi pembayaran.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Notes -->
                <div class="form-section">
                    <h3 class="section-title">Additional Notes</h3>
                    
                    <div class="form-group">
                        <label for="notes" class="form-label">Order Notes (Optional)</label>
                        <textarea id="notes" 
                                  name="notes" 
                                  class="form-input form-textarea" 
                                  placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                    </div>
                </div>
                
                <div class="security-info">
                    <div class="security-title">🔒 Secure Checkout</div>
                    <div class="security-text">
                        Your personal information is protected with SSL encryption. We never store your payment details.
                    </div>
                </div>
            </form>
            
            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title">Order Summary</h3>
                
                <div class="order-items">
                    @foreach($cart as $id => $details)
                        <div class="order-item">
                            <img src="{{ isset($details['image']) && $details['image'] ? asset('storage/' . $details['image']) : asset('images/MOCKUP DEPAN.jpeg.jpg') }}" 
                                 alt="{{ $details['name'] }}" 
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ $details['name'] }}</div>
                                @if(isset($details['size']) || isset($details['color']))
                                    <div class="item-attributes">
                                        @if(isset($details['size']) && $details['size'])
                                            <span class="attribute-badge size-badge">Size: {{ $details['size'] }}</span>
                                        @endif
                                        @if(isset($details['color']) && $details['color'])
                                            <span class="attribute-badge color-badge">Color: {{ $details['color'] }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="item-quantity">Qty: {{ $details['quantity'] }}</div>
                            </div>
                            <div class="item-price">
                                Rp. {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Shipping</span>
                    <span class="summary-value {{ $shipping == 0 ? 'free-shipping' : '' }}">
                        @if($shipping == 0)
                            FREE
                        @else
                            Rp. {{ number_format($shipping, 0, ',', '.') }}
                        @endif
                    </span>
                </div>
                
                <div class="summary-row">
                    <span class="summary-label" style="font-size: 1.1rem; font-weight: 600;">Total</span>
                    <span class="total-value">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                
                <button type="submit" form="checkoutForm" class="place-order-btn" id="placeOrderBtn">
                    Place Order
                </button>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkoutForm');
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    
    // Form submission
    checkoutForm.addEventListener('submit', function(e) {
        // Add loading state
        placeOrderBtn.disabled = true;
        placeOrderBtn.textContent = 'Processing...';
        checkoutForm.classList.add('loading');
        
        // Validate required fields
        const requiredFields = checkoutForm.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#FF3B3F';
            } else {
                field.style.borderColor = '#ddd';
            }
        });
        
        // Check if payment method is selected
        const paymentMethods = checkoutForm.querySelectorAll('input[name="payment_method"]');
        const isPaymentSelected = Array.from(paymentMethods).some(radio => radio.checked);
        
        if (!isPaymentSelected) {
            isValid = false;
            alert('Please select a payment method.');
        }
        
        if (!isValid) {
            e.preventDefault();
            placeOrderBtn.disabled = false;
            placeOrderBtn.textContent = 'Place Order';
            checkoutForm.classList.remove('loading');
        }
    });
    
    // Real-time validation
    const inputs = checkoutForm.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#FF3B3F';
            } else {
                this.style.borderColor = '#ddd';
            }
        });
        
        input.addEventListener('input', function() {
            if (this.style.borderColor === 'rgb(255, 59, 63)' && this.value.trim()) {
                this.style.borderColor = '#ddd';
            }
        });
    });
    
    // Phone number formatting
    const phoneInput = document.getElementById('customer_phone');
    phoneInput.addEventListener('input', function() {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9+\-\s]/g, '');
    });
    
    // Email validation
    const emailInput = document.getElementById('customer_email');
    emailInput.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !emailRegex.test(this.value)) {
            this.style.borderColor = '#FF3B3F';
        }
    });
});
</script>
@endpush