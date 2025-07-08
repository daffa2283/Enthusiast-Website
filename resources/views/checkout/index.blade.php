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
                               value="{{ old('customer_name') }}" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="customer_email" class="form-label">Email Address *</label>
                        <input type="email" 
                               id="customer_email" 
                               name="customer_email" 
                               class="form-input" 
                               value="{{ old('customer_email') }}" 
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
                                   id="credit_card" 
                                   name="payment_method" 
                                   value="credit_card" 
                                   class="payment-radio"
                                   {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                            <label for="credit_card" class="payment-label">
                                <svg class="payment-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                                </svg>
                                <span class="payment-text">Credit Card</span>
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
                        
                        <div class="payment-option">
                            <input type="radio" 
                                   id="cod" 
                                   name="payment_method" 
                                   value="cod" 
                                   class="payment-radio"
                                   {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                            <label for="cod" class="payment-label">
                                <svg class="payment-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                                </svg>
                                <span class="payment-text">Cash on Delivery</span>
                            </label>
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
<<<<<<< HEAD
                            <img src="{{ asset($details['image'] ?? 'images/MOCKUP DEPAN.jpeg.jpg') }}" 
=======
                            <img src="{{ asset('storage/' .$details['image'] ?? 'images/MOCKUP DEPAN.jpeg.jpg') }}" 
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
                                 alt="{{ $details['name'] }}" 
                                 class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{ $details['name'] }}</div>
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