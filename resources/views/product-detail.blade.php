@extends('layouts.app')

@section('title', $product->name . ' - EnthusiastVerse')

@section('content')
<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('products') }}">Products</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </nav>

        <!-- Product Detail Card -->
        <div class="product-detail-card">
            <div class="product-detail-grid">
                <!-- Product Image Section -->
                <div class="product-image-section">
                    <div class="image-slider">
                        <div class="slider-container">
                            <div class="slider-track" id="productSliderTrack">
                                <div class="slide active">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }} - Front" id="mainProductImage">
                                </div>
                                @if($product->back_image)
                                    <div class="slide">
                                        <img src="{{ asset('storage/' . $product->back_image) }}" alt="{{ $product->name }} - Back">
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($product->back_image)
                            <button class="slider-arrow slider-arrow-left" id="productSliderPrev">
                                <span>&lt;</span>
                            </button>
                            <button class="slider-arrow slider-arrow-right" id="productSliderNext">
                                <span>&gt;</span>
                            </button>
                            <div class="slider-dots">
                                <span class="dot active" data-slide="0"></span>
                                <span class="dot" data-slide="1"></span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info Section -->
                <div class="product-info-section">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <p class="product-category">{{ ucfirst($product->category) }}</p>
                    <p class="product-price">{{ $product->formatted_price }}</p>
                    
                    <div class="product-description">
                        <h4>Description</h4>
                        <div class="description-content">
                            {!! $product->description ?: '<p>High-quality product crafted with attention to detail and premium materials.</p>' !!}
                        </div>
                    </div>
                    
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
                        </div>
                    </div>
                    
                    <div class="product-actions">
                        @if($product->stock > 0)
                            @auth
                                <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                    <span>Add to Cart</span>
                                </button>
                            @else
                                <button class="add-to-cart-btn guest-add-to-cart">
                                    <span>LOGIN TO ADD TO CART</span>
                                </button>
                            @endauth
                        @else
                            <button class="add-to-cart-btn out-of-stock" disabled>
                                <span>Out of Stock</span>
                            </button>
                        @endif
                        <p class="stock-info {{ $product->stock == 0 ? 'out-of-stock' : '' }}">
                            @if($product->stock > 0)
                                {{ $product->stock }} in stock
                            @else
                                Out of stock
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Product Detail Section */
.product-detail-section {
    padding: 3rem 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 80vh;
    margin-top: 80px;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.9rem;
    color: #6B7280;
    justify-content: center;
}

.breadcrumb a {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.breadcrumb a:hover {
    color: #ff6b6b;
}

.breadcrumb span {
    color: #9CA3AF;
}

/* Product Detail Card */
.product-detail-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid rgba(255, 59, 63, 0.1);
}

.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    padding: 40px;
}

/* Product Image Section */
.product-image-section {
    position: relative;
}

.image-slider {
    position: relative;
    width: 100%;
    height: 500px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.slider-container {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.slider-track {
    display: flex;
    width: 200%;
    height: 100%;
    transition: transform 0.3s ease;
}

.slide {
    width: 50%;
    height: 100%;
    flex-shrink: 0;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: bold;
    transition: all 0.3s ease;
    z-index: 10;
}

.slider-arrow:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: translateY(-50%) scale(1.1);
}

.slider-arrow-left {
    left: 15px;
}

.slider-arrow-right {
    right: 15px;
}

.slider-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: white;
    transform: scale(1.2);
}

.dot:hover {
    background: rgba(255, 255, 255, 0.8);
}

/* Product Info Section */
.product-info-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.2;
}

.product-category {
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0;
    font-weight: 600;
}

.product-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-color);
    margin: 0;
}

.product-description h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.product-description p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Description Content Styling */
.description-content {
    color: #666;
    line-height: 1.6;
}

.description-content p {
    margin: 0 0 10px 0;
}

.description-content p:last-child {
    margin-bottom: 0;
}

.description-content ul,
.description-content ol {
    margin: 10px 0;
    padding-left: 20px;
}

.description-content li {
    margin-bottom: 5px;
}

.description-content strong {
    font-weight: 600;
    color: #1a1a1a;
}

.description-content em {
    font-style: italic;
}

.description-content a {
    color: var(--accent-color);
    text-decoration: none;
}

.description-content a:hover {
    text-decoration: underline;
}

/* Product Options */
.product-options {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.product-options h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 10px 0;
}

.size-buttons,
.color-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.size-btn,
.color-btn {
    padding: 8px 16px;
    border: 2px solid #e5e5e5;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.size-btn:hover,
.color-btn:hover,
.size-btn.active,
.color-btn.active {
    border-color: var(--accent-color);
    background: var(--accent-color);
    color: white;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #e5e5e5;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    border-color: var(--accent-color);
    background: var(--accent-color);
    color: white;
}

#quantity {
    width: 80px;
    height: 40px;
    text-align: center;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
}

/* Product Actions */
.product-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 59, 63, 0.3);
}

.add-to-cart-btn.guest-add-to-cart {
    background: linear-gradient(135deg, #6B7280, #4B5563) !important;
    border: 2px solid #9CA3AF;
}

.add-to-cart-btn.guest-add-to-cart:hover {
    background: linear-gradient(135deg, #4B5563, #374151) !important;
    border-color: #6B7280;
}

.add-to-cart-btn.out-of-stock {
    background: #6c757d !important;
    cursor: not-allowed;
    opacity: 0.6;
}

.add-to-cart-btn.out-of-stock:hover {
    background: #6c757d !important;
    transform: none;
    box-shadow: none;
}

.stock-info {
    color: #10b981;
    font-weight: 600;
    margin: 0;
    text-align: center;
    font-size: 0.9rem;
}

.stock-info.out-of-stock {
    color: #ef4444;
}

/* Loading state for buttons */
.add-to-cart-btn.loading {
    opacity: 0.7;
    pointer-events: none;
}

.add-to-cart-btn.loading span {
    opacity: 0;
}

.add-to-cart-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
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

/* Responsive Design */
@media (max-width: 768px) {
    .product-detail-section {
        padding: 2rem 0;
        margin-top: 70px;
    }
    
    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 30px 20px;
    }
    
    .image-slider {
        height: 400px;
    }
    
    .product-title {
        font-size: 1.6rem;
    }
    
    .product-price {
        font-size: 1.5rem;
    }
    
    .breadcrumb {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .product-detail-section {
        padding: 1.5rem 0;
    }
    
    .container {
        padding: 0 0.5rem;
    }
    
    .product-detail-grid {
        padding: 20px 15px;
        gap: 25px;
    }
    
    .image-slider {
        height: 300px;
    }
    
    .product-title {
        font-size: 1.4rem;
    }
    
    .product-price {
        font-size: 1.3rem;
    }
    
    .size-buttons,
    .color-buttons {
        gap: 8px;
    }
    
    .size-btn,
    .color-btn {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Slider Functionality
    let currentSlide = 0;
    const totalSlides = document.querySelectorAll('.slide').length;
    
    const sliderTrack = document.getElementById('productSliderTrack');
    const prevBtn = document.getElementById('productSliderPrev');
    const nextBtn = document.getElementById('productSliderNext');
    const dots = document.querySelectorAll('.slider-dots .dot');
    
    function updateSlider() {
        if (sliderTrack && totalSlides > 1) {
            const translateX = -currentSlide * 50;
            sliderTrack.style.transform = `translateX(${translateX}%)`;
            
            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }
    
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateSlider();
    }
    
    // Event listeners for slider controls
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => goToSlide(index));
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (totalSlides > 1) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        }
    });

    // Quantity controls
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.minus');
    const plusBtn = document.querySelector('.plus');
    const maxStock = parseInt(quantityInput.getAttribute('max'));

    if (minusBtn) {
        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    }

    if (plusBtn) {
        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            }
        });
    }

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
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            if (this.classList.contains('guest-add-to-cart')) {
                // Show login modal for guests
                const productName = document.querySelector('.product-title').textContent;
                showLoginModal(productName);
            } else if (this.classList.contains('out-of-stock')) {
                // Do nothing for out of stock
                return;
            } else {
                const productId = this.getAttribute('data-product-id');
                const quantity = document.getElementById('quantity').value;
                const selectedSize = document.querySelector('.size-btn.active')?.getAttribute('data-size') || '';
                const selectedColor = document.querySelector('.color-btn.active')?.getAttribute('data-color') || '';

                addToCart(productId, quantity, selectedSize, selectedColor);
            }
        });
    }
});

function addToCart(productId, quantity, size, color) {
    const button = document.querySelector('.add-to-cart-btn');
    const originalText = button.innerHTML;
    
    // Check if size is required and selected
    const sizeButtons = document.querySelectorAll('.size-btn');
    const hasSizes = sizeButtons.length > 0;
    
    if (hasSizes && !size) {
        // Show error message for missing size selection
        showToast('Size Required!', 'Please select a size before adding to cart.', 'error');
        
        // Highlight size section
        const sizeOptions = document.querySelector('.size-options');
        if (sizeOptions) {
            sizeOptions.style.border = '2px solid #EF4444';
            sizeOptions.style.borderRadius = '8px';
            sizeOptions.style.padding = '10px';
            setTimeout(() => {
                sizeOptions.style.border = '';
                sizeOptions.style.borderRadius = '';
                sizeOptions.style.padding = '';
            }, 3000);
        }
        return;
    }
    
    // Show loading state
    button.classList.add('loading');
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
            // Update cart counter
            const cartCounter = document.querySelector('.cart-counter');
            if (cartCounter) {
                cartCounter.textContent = data.cart_count;
                cartCounter.classList.add('updated');
                setTimeout(() => cartCounter.classList.remove('updated'), 600);
            }
            
            // Show success toast
            const productName = document.querySelector('.product-title').textContent;
            const sizeText = size ? ` (Size: ${size})` : '';
            showToast('Added to Cart!', `${productName}${sizeText} has been added to your cart.`, 'success');
        } else {
            showToast('Error!', data.message || 'Failed to add product to cart.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error!', 'Something went wrong. Please try again.', 'error');
    })
    .finally(() => {
        // Restore button state
        button.classList.remove('loading');
        button.disabled = false;
    });
}

// Show login modal for guests
function showLoginModal(productName) {
    // Remove existing modal if any
    const existingModal = document.getElementById('loginModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Create modal HTML
    const modalHTML = `
        <div id="loginModal" class="login-modal">
            <div class="login-modal-overlay"></div>
            <div class="login-modal-content">
                <button class="login-modal-close">&times;</button>
                <div class="login-modal-body">
                    <div class="login-modal-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h2>Buat Akun untuk Melanjutkan</h2>
                    <p>Untuk membeli <strong>${productName}</strong>, Anda perlu membuat akun terlebih dahulu.</p>
                    <div class="login-benefits">
                        <div class="benefit-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                            <span>Simpan produk favorit</span>
                        </div>
                        <div class="benefit-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                            <span>Lacak pesanan Anda</span>
                        </div>
                        <div class="benefit-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                            <span>Checkout lebih cepat</span>
                        </div>
                        <div class="benefit-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20,6 9,17 4,12"/>
                            </svg>
                            <span>Dapatkan penawaran eksklusif</span>
                        </div>
                    </div>
                    <div class="login-modal-actions">
                        <a href="/register" class="btn-register">Daftar Sekarang</a>
                        <a href="/login" class="btn-login">Sudah Punya Akun? Login</a>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Show modal with animation
    const modal = document.getElementById('loginModal');
    setTimeout(() => modal.classList.add('show'), 10);
    
    // Add event listeners
    const closeBtn = modal.querySelector('.login-modal-close');
    const overlay = modal.querySelector('.login-modal-overlay');
    
    closeBtn.addEventListener('click', closeLoginModal);
    overlay.addEventListener('click', closeLoginModal);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.remove();
            document.body.style.overflow = '';
        }, 300);
    }
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLoginModal();
    }
});

function showToast(title, message, type = 'success') {
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

// Add login modal styles
const loginModalStyles = `
.login-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.login-modal.show {
    opacity: 1;
    visibility: visible;
}

.login-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
}

.login-modal-content {
    position: relative;
    background: white;
    border-radius: 20px;
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    transform: scale(0.9) translateY(-20px);
    transition: all 0.3s ease;
}

.login-modal.show .login-modal-content {
    transform: scale(1) translateY(0);
}

.login-modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.1);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.login-modal-close:hover {
    background: rgba(0, 0, 0, 0.2);
    transform: rotate(90deg);
}

.login-modal-body {
    padding: 40px;
    text-align: center;
}

.login-modal-icon {
    margin-bottom: 20px;
    color: #6B7280;
}

.login-modal-body h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 15px;
}

.login-modal-body p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.login-benefits {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
    text-align: left;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #374151;
}

.benefit-item svg {
    color: #10B981;
    flex-shrink: 0;
}

.login-modal-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn-register {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 15px 30px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
    color: white;
    text-decoration: none;
}

.btn-login {
    color: #6B7280;
    text-decoration: none;
    font-weight: 500;
    padding: 10px;
    transition: color 0.3s ease;
}

.btn-login:hover {
    color: #2563eb;
    text-decoration: none;
}

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
`;

// Add login modal styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = loginModalStyles;
document.head.appendChild(styleSheet);
</script>
@endpush 