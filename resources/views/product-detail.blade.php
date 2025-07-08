@extends('layouts.app')

@section('title', $product->name . ' - EnthusiastVerse')

@section('content')
<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-grid">
            <!-- Product Image -->
            <div class="product-image-section">
                <div class="main-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" id="mainProductImage">
                </div>
                <div class="thumbnail-images">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="thumbnail active" onclick="changeImage(this)">
                    @if($product->back_image)
                        <img src="{{ asset('storage/' . $product->back_image) }}" alt="{{ $product->name }} - Back" class="thumbnail" onclick="changeImage(this)">
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info-section">
                <nav class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <a href="{{ route('products') }}">Products</a>
                    <span>/</span>
                    <span>{{ $product->name }}</span>
                </nav>

                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-category">{{ $product->category }}</p>
                <p class="product-price">{{ $product->formatted_price }}</p>

                <div class="product-description">
                    <h3>Description</h3>
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Product Options -->
                <div class="product-options">
                    @if($product->size)
                        <div class="size-options">
                            <h4>Size</h4>
                            <div class="size-buttons">
                                @php
                                    $sizes = explode(',', $product->size);
                                @endphp
                                @foreach($sizes as $index => $size)
                                    <button type="button" class="size-btn {{ $index === 0 ? 'active' : '' }}" data-size="{{ trim($size) }}">
                                        {{ trim($size) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($product->color)
                        <div class="color-options">
                            <h4>Color</h4>
                            <div class="color-buttons">
                                @php
                                    $colors = explode(',', $product->color);
                                @endphp
                                @foreach($colors as $index => $color)
                                    <button type="button" class="color-btn {{ $index === 0 ? 'active' : '' }}" data-color="{{ trim($color) }}">
                                        {{ trim($color) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="quantity-section">
                        <h4>Quantity</h4>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus">-</button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}">
                            <button type="button" class="quantity-btn plus">+</button>
                        </div>
                        <p class="stock-info">In Stock: {{ $product->stock }} items</p>
                    </div>
                </div>

                <!-- Add to Cart Section -->
                <div class="add-to-cart-section">
                    <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
                    <button class="buy-now-btn" data-product-id="{{ $product->id }}">
                        <span>Buy Now</span>
                    </button>
                </div>

                <!-- Product Features -->
                <div class="product-features">
                    <div class="feature">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Free Shipping</span>
                    </div>
                    <div class="feature">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12l2 2 4-4"></path>
                            <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"></path>
                        </svg>
                        <span>Quality Guarantee</span>
                    </div>
                    <div class="feature">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>
                        <span>Premium Quality</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="related-products">
    <div class="container">
        <h2>You Might Also Like</h2>
        <div class="products-grid">
            <!-- Related products will be loaded here -->
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.product-detail-section {
    padding: 2rem 0;
    background: #f8fafc;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

.product-image-section {
    position: sticky;
    top: 2rem;
}

.main-image {
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.main-image img {
    width: 100%;
    height: auto;
    display: block;
}

.thumbnail-images {
    display: flex;
    gap: 0.5rem;
}

.thumbnail {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.thumbnail.active {
    border-color: #10B981;
}

.thumbnail:hover {
    transform: scale(1.05);
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: #6B7280;
}

.breadcrumb a {
    color: #10B981;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 0.5rem;
}

.product-category {
    color: #6B7280;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.product-price {
    font-size: 2rem;
    font-weight: 700;
    color: #10B981;
    margin-bottom: 2rem;
}

.product-description {
    margin-bottom: 2rem;
}

.product-description h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1F2937;
}

.product-description p {
    color: #6B7280;
    line-height: 1.6;
}

.product-options {
    margin-bottom: 2rem;
}

.product-options h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1F2937;
}

.size-buttons, .color-buttons {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.size-btn, .color-btn {
    padding: 0.5rem 1rem;
    border: 2px solid #E5E7EB;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.size-btn.active, .color-btn.active {
    border-color: #10B981;
    background: #10B981;
    color: white;
}

.size-btn:hover, .color-btn:hover {
    border-color: #10B981;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #E5E7EB;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    border-color: #10B981;
    color: #10B981;
}

#quantity {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 2px solid #E5E7EB;
    border-radius: 8px;
    font-size: 1rem;
}

.stock-info {
    color: #6B7280;
    font-size: 0.9rem;
}

.add-to-cart-section {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.add-to-cart-btn, .buy-now-btn {
    flex: 1;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.buy-now-btn {
    background: linear-gradient(135deg, #1F2937, #374151);
    color: white;
}

.buy-now-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(31, 41, 55, 0.3);
}

.product-features {
    display: flex;
    gap: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6B7280;
    font-size: 0.9rem;
}

.feature svg {
    width: 20px;
    height: 20px;
    color: #10B981;
}

.related-products {
    padding: 3rem 0;
    background: white;
}

.related-products h2 {
    text-align: center;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: #1F2937;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .add-to-cart-section {
        flex-direction: column;
    }
    
    .product-features {
        flex-direction: column;
        gap: 1rem;
    }
}

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
</style>
@endpush

@push('scripts')
<script>
// Image gallery functionality
function changeImage(thumbnail) {
    const mainImage = document.getElementById('mainProductImage');
    mainImage.src = thumbnail.src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    thumbnail.classList.add('active');
}

// Quantity controls
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.minus');
    const plusBtn = document.querySelector('.plus');
    const maxStock = parseInt(quantityInput.getAttribute('max'));

    minusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    plusBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < maxStock) {
            quantityInput.value = currentValue + 1;
        }
    });

    // Size and color selection
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Add to cart functionality
    document.querySelector('.add-to-cart-btn').addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        const quantity = document.getElementById('quantity').value;
        const selectedSize = document.querySelector('.size-btn.active')?.getAttribute('data-size') || '';
        const selectedColor = document.querySelector('.color-btn.active')?.getAttribute('data-color') || '';

        addToCart(productId, quantity, selectedSize, selectedColor);
    });

    // Buy now functionality
    document.querySelector('.buy-now-btn').addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        const quantity = document.getElementById('quantity').value;
        const selectedSize = document.querySelector('.size-btn.active')?.getAttribute('data-size') || '';
        const selectedColor = document.querySelector('.color-btn.active')?.getAttribute('data-color') || '';

        // Add to cart first, then redirect to checkout
        addToCart(productId, quantity, selectedSize, selectedColor, true);
    });
});

function addToCart(productId, quantity, size, color, redirectToCheckout = false) {
    const button = document.querySelector('.add-to-cart-btn');
    const originalText = button.innerHTML;
    
    // Show loading state
    button.innerHTML = '<span>Adding...</span>';
    button.disabled = true;

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity,
            size: size,
            color: color
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Success!', data.message, 'success');
            
            // Update cart count if it exists
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = data.cart_count || 0;
            }

            if (redirectToCheckout) {
                setTimeout(() => {
                    window.location.href = '/checkout';
                }, 1000);
            }
        } else {
            showToast('Error!', data.message || 'Failed to add to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error!', 'Something went wrong. Please try again.', 'error');
    })
    .finally(() => {
        // Restore button state
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function showToast(title, message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = type === 'success' 
        ? '<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
        : '<svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
    
    toast.innerHTML = `
        ${icon}
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Show toast
    setTimeout(() => toast.classList.add('show'), 100);
    
    // Hide toast after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => document.body.removeChild(toast), 300);
    }, 3000);
}
</script>
@endpush 