@extends('layouts.app')

@section('title', 'Shopping Cart - EnthusiastVerse')

@push('styles')
<style>
.cart-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.cart-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.cart-header {
    text-align: center;
    margin-bottom: 3rem;
}

.cart-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    letter-spacing: 1px;
}

.cart-subtitle {
    color: #666;
    font-size: 1.1rem;
}

.cart-content {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 2rem;
    align-items: start;
}

.cart-items {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.cart-item:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.cart-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.item-image {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    margin-right: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.item-details {
    flex: 1;
}

.item-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.item-price {
    color: #666;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.item-attributes {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    flex-wrap: wrap;
}

.attribute-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease;
}

.attribute-badge svg {
    width: 12px;
    height: 12px;
    opacity: 0.7;
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

.attribute-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.quantity-btn {
    width: 32px;
    height: 32px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-weight: bold;
}

.quantity-btn:hover {
    background: #f0f0f0;
    border-color: #bbb;
}

.quantity-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.quantity-input {
    width: 60px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0.5rem;
    font-weight: 600;
}

.item-actions {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1rem;
}

.item-total {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a1a1a;
}

.remove-btn {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remove-btn:hover {
    background: linear-gradient(135deg, #ee5a52, #ff6b6b);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(238, 90, 82, 0.3);
}

.cart-summary {
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

.checkout-btn {
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
    text-decoration: none;
    display: block;
    text-align: center;
}

.checkout-btn:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
    color: white;
    text-decoration: none;
}

.checkout-btn.disabled {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
}

.checkout-btn.disabled:hover {
    background: #6c757d;
    transform: none;
    box-shadow: none;
}

.empty-cart {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.empty-cart-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #999;
}

.empty-cart-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.empty-cart-text {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.shop-now-btn {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
    text-decoration: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.shop-now-btn:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
    color: white;
    text-decoration: none;
}

.continue-shopping {
    text-align: center;
    margin-top: 2rem;
}

.continue-shopping a {
    color: #666;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.continue-shopping a:hover {
    color: #1a1a1a;
}

.login-notice {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border: 1px solid #f59e0b;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
    text-align: center;
}

.login-notice-text {
    color: #92400e;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.login-notice a {
    color: #92400e;
    font-weight: 600;
    text-decoration: underline;
}

.login-notice a:hover {
    color: #78350f;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .cart-item {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .item-image {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .item-actions {
        align-items: center;
    }
    
    .cart-title {
        font-size: 2rem;
    }
    
    .cart-summary {
        position: static;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

/* Success Animation */
@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.success-animation {
    animation: successPulse 0.3s ease;
}

/* Toast Notifications */
.toast {
    position: fixed;
    top: 100px;
    right: 20px;
    background: white;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    z-index: 10000;
    transform: translateX(400px);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border-left: 4px solid #10B981;
}

.toast.show {
    transform: translateX(0);
}

.toast.error {
    border-left-color: #EF4444;
}

.toast-title {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.25rem;
}

.toast-message {
    color: #666;
    font-size: 0.9rem;
}
</style>
@endpush

@section('content')
<section class="cart-container">
    <div class="cart-wrapper">
        <div class="cart-header">
            <h1 class="cart-title">Shopping Cart</h1>
            <p class="cart-subtitle">Review your items before checkout</p>
        </div>
        
        @if(session('cart') && count(session('cart')) > 0)
            <div class="cart-content">
                <div class="cart-items">
                    @foreach(session('cart') as $id => $details)
                        <div class="cart-item" data-item-id="{{ $id }}">
                            <img src="{{ isset($details['image']) && $details['image'] ? asset('storage/' . $details['image']) : asset('images/MOCKUP DEPAN.jpeg.jpg') }}" 
                                 alt="{{ $details['name'] }}" 
                                 class="item-image">
                            
                            <div class="item-details">
                                <h4 class="item-name">{{ $details['name'] }}</h4>
                                <p class="item-price">Rp. {{ number_format($details['price'], 0, ',', '.') }} each</p>
                                
                                @if(isset($details['size']) || isset($details['color']))
                                    <div class="item-attributes">
                                        @if(isset($details['size']) && $details['size'])
                                            <span class="attribute-badge size-badge">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                                Size: {{ $details['size'] }}
                                            </span>
                                        @endif
                                        @if(isset($details['color']) && $details['color'])
                                            <span class="attribute-badge color-badge">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                    <circle cx="12" cy="12" r="10"/>
                                                </svg>
                                                Color: {{ $details['color'] }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="quantity-controls">
                                    <button class="quantity-btn decrease-qty" data-id="{{ $id }}" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>−</button>
                                    <input type="number" 
                                           class="quantity-input" 
                                           value="{{ $details['quantity'] }}" 
                                           min="1" 
                                           data-id="{{ $id }}"
                                           readonly>
                                    <button class="quantity-btn increase-qty" data-id="{{ $id }}">+</button>
                                </div>
                            </div>
                            
                            <div class="item-actions">
                                <div class="item-total">
                                    Rp. {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                </div>
                                <button class="remove-btn" data-id="{{ $id }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="cart-summary">
                    <h3 class="summary-title">Order Summary</h3>
                    
                    @php
                        $subtotal = 0;
                        $itemCount = 0;
                        foreach(session('cart', []) as $details) {
                            $subtotal += $details['price'] * $details['quantity'];
                            $itemCount += $details['quantity'];
                        }
                        $shipping = $subtotal > 500000 ? 0 : 15000; // Free shipping over 500k
                        $total = $subtotal + $shipping;
                    @endphp
                    
                    <div class="summary-row">
                        <span class="summary-label">Items ({{ $itemCount }})</span>
                        <span class="summary-value">Rp. {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Shipping</span>
                        <span class="summary-value">
                            @if($shipping == 0)
                                <span style="color: #10B981; font-weight: 600;">FREE</span>
                            @else
                                Rp. {{ number_format($shipping, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    
                    @if($subtotal < 500000 && $subtotal > 0)
                        <div class="summary-row" style="border: none; padding: 0.5rem 0; font-size: 0.9rem;">
                            <span style="color: #10B981;">
                                Add Rp. {{ number_format(500000 - $subtotal, 0, ',', '.') }} more for FREE shipping!
                            </span>
                        </div>
                    @endif
                    
                    <div class="summary-row">
                        <span class="summary-label" style="font-size: 1.1rem; font-weight: 600;">Total</span>
                        <span class="total-value">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    @guest
                        <div class="login-notice">
                            <div class="login-notice-text">Please login to proceed with checkout</div>
                            <a href="{{ route('login') }}">Login here</a> or <a href="{{ route('register') }}">Create an account</a>
                        </div>
                        <a href="{{ route('login') }}" class="checkout-btn disabled">
                            Login to Checkout
                        </a>
                    @else
                        <a href="{{ route('checkout.index') }}" class="checkout-btn">
                            Proceed to Checkout
                        </a>
                    @endguest
                    
                    <div class="continue-shopping">
                        <a href="{{ route('products') }}">← Continue Shopping</a>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                    </svg>
                </div>
                <h3 class="empty-cart-title">Your cart is empty</h3>
                <p class="empty-cart-text">
                    Looks like you haven't added any items to your cart yet.<br>
                    Start shopping to fill it up with amazing products!
                </p>
                <a href="{{ route('products') }}" class="shop-now-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove item functionality
    const removeButtons = document.querySelectorAll('.remove-btn');
    const increaseButtons = document.querySelectorAll('.increase-qty');
    const decreaseButtons = document.querySelectorAll('.decrease-qty');
    
    // Toast notification function
    function showToast(type, title, message) {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.add('show'), 100);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Remove item
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const cartItem = this.closest('.cart-item');
            const itemName = cartItem.querySelector('.item-name').textContent;
            
            // Add loading state
            cartItem.classList.add('loading');
            
            fetch('{{ route("cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success toast
                    showToast('success', 'Item Removed', `${itemName} has been removed from your cart.`);
                    
                    // Animate removal
                    cartItem.style.transform = 'translateX(-100%)';
                    cartItem.style.opacity = '0';
                    
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                } else {
                    cartItem.classList.remove('loading');
                    showToast('error', 'Error', 'Failed to remove item from cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cartItem.classList.remove('loading');
                showToast('error', 'Error', 'Something went wrong. Please try again.');
            });
        });
    });
    
    // Increase quantity
    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            updateQuantity(itemId, 1);
        });
    });
    
    // Decrease quantity
    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const quantityInput = document.querySelector(`input[data-id="${itemId}"]`);
            const currentQty = parseInt(quantityInput.value);
            
            if (currentQty > 1) {
                updateQuantity(itemId, -1);
            }
        });
    });
    
    function updateQuantity(itemId, change) {
        const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
        const itemName = cartItem.querySelector('.item-name').textContent;
        cartItem.classList.add('loading');
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: itemId,
                quantity: change
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success toast
                const action = change > 0 ? 'increased' : 'decreased';
                showToast('success', 'Quantity Updated', `${itemName} quantity has been ${action}.`);
                
                // Add success animation
                cartItem.classList.add('success-animation');
                
                setTimeout(() => {
                    location.reload();
                }, 300);
            } else {
                cartItem.classList.remove('loading');
                showToast('error', 'Error', data.message || 'Failed to update quantity.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            cartItem.classList.remove('loading');
            showToast('error', 'Error', 'Something went wrong. Please try again.');
        });
    }
    
    // Update cart counter in header
    function updateCartCounter() {
        const cartCounter = document.querySelector('#cartCounter');
        if (cartCounter) {
            fetch('{{ route("cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    cartCounter.textContent = data.count || 0;
                })
                .catch(error => console.error('Error updating cart counter:', error));
        }
    }
    
    // Update cart counter on page load
    updateCartCounter();
});
</script>
@endpush