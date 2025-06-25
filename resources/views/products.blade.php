@extends('layouts.app')

@section('title', 'Products - EnthusiastVerse')

@section('content')
<section class="products" id="products" style="margin-top: 100px;">
    <h2 class="section-title">Our Collection</h2>
    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="{{ $product->id }}">Quick View</button>
                    </div>  
                </div>
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-price">{{ $product->formatted_price }}</p>
                    <button class="add-to-cart" data-product-id="{{ $product->id }}">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                </div>
            </div>
        @empty
            <!-- Default products when no data from database -->
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('images/MOCKUP DEPAN.jpeg.jpg') }}" alt="Enthusias Tee">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="1">Quick View</button>
                    </div>
                </div>
                <div class="product-details">
                    <h3 class="product-name">Essential Crewneck</h3>
                    <p class="product-price">Rp. 399.000</p>
                    <button class="add-to-cart" data-product-id="1">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('images/MOCKUP DEPAN11.jpeg.jpg') }}" alt="Enthusias Hoodie">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="2">Quick View</button>
                    </div>
                </div>
                <div class="product-details">
                    <h3 class="product-name">Premium Hoodie</h3>
                    <p class="product-price">Rp. 599.000</p>
                    <button class="add-to-cart" data-product-id="2">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('images/MOCKUP DEPAN.jpeg.jpg') }}" alt="Classic Tee">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="3">Quick View</button>
                    </div>
                </div>
                <div class="product-details">
                    <h3 class="product-name">Classic Tee</h3>
                    <p class="product-price">Rp. 299.000</p>
                    <button class="add-to-cart" data-product-id="3">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('images/MOCKUP DEPAN11.jpeg.jpg') }}" alt="Street Hoodie">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="4">Quick View</button>
                    </div>
                </div>
                <div class="product-details">
                    <h3 class="product-name">Street Hoodie</h3>
                    <p class="product-price">Rp. 699.000</p>
                    <button class="add-to-cart" data-product-id="4">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection

@push('styles')
<style>
/* Toast Notification Styles */
.toast {
    position: fixed;
    top: 100px;
    right: 20px;
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    z-index: 10000;
    transform: translateX(400px);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
    max-width: 350px;
}

.toast.show {
    transform: translateX(0);
}

.toast.error {
    background: linear-gradient(135deg, #EF4444, #DC2626);
}

.toast-icon {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
}

.toast-content {
    flex: 1;
}

.toast-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.toast-message {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Loading state for buttons */
.add-to-cart.loading {
    opacity: 0.7;
    pointer-events: none;
}

.add-to-cart.loading span {
    opacity: 0;
}

.add-to-cart.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Success animation for cart counter */
.cart-counter.updated {
    animation: bounce 0.6s ease;
}

@keyframes bounce {
    0%, 20%, 60%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    80% {
        transform: translateY(-5px);
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartCounter = document.querySelector('.cart-counter');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const productName = this.closest('.product-card').querySelector('.product-name').textContent;
            
            // Add loading state
            this.classList.add('loading');
            
            // Send AJAX request to add product to cart
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId || 1,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                // Remove loading state
                this.classList.remove('loading');
                
                if (data.success) {
                    // Update cart counter with animation
                    cartCounter.textContent = data.cart_count;
                    cartCounter.classList.add('updated');
                    setTimeout(() => cartCounter.classList.remove('updated'), 600);
                    
                    // Show success toast
                    showToast('success', 'Added to Cart!', `${productName} has been added to your cart.`);
                } else {
                    // Show error toast
                    showToast('error', 'Error!', data.message || 'Failed to add product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.classList.remove('loading');
                
                // Fallback: just increment counter
                let currentCount = parseInt(cartCounter.textContent) || 0;
                cartCounter.textContent = currentCount + 1;
                cartCounter.classList.add('updated');
                setTimeout(() => cartCounter.classList.remove('updated'), 600);
                
                // Show error toast
                showToast('error', 'Error!', 'Something went wrong. Please try again.');
            });
        });
    });
    
    // Toast notification function
    function showToast(type, title, message) {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.toast');
        existingToasts.forEach(toast => toast.remove());
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        const icon = type === 'success' 
            ? `<svg class="toast-icon" viewBox="0 0 24 24" fill="currentColor">
                 <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
               </svg>`
            : `<svg class="toast-icon" viewBox="0 0 24 24" fill="currentColor">
                 <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
               </svg>`;
        
        toast.innerHTML = `
            ${icon}
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
        `;
        
        // Add to page
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush