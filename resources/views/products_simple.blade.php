@extends('layouts.app')

@section('title', 'Products - EnthusiastVerse')

@section('content')
<!-- Products Hero Section -->
<section class="products-hero">
    <div class="products-hero-content">
        <h1>Our Collection</h1>
        <p class="hero-subtitle">Discover Your Style</p>
    </div>
    <div class="hero-overlay"></div>
</section>

<!-- Filters Section -->
<section class="products-filters">
    <div class="container">
        <div class="filters-wrapper">
            <div class="search-filter">
                <form action="{{ route('products') }}" method="GET" class="filter-form">
                    <input type="text" 
                           name="search" 
                           placeholder="Search products..." 
                           value="{{ request('search') }}"
                           class="filter-search-input">
                    <button type="submit" class="filter-search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
            
            <div class="results-count">
                <span>{{ $products->count() }} {{ $products->count() == 1 ? 'product' : 'products' }} found</span>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="products-main">
    <div class="container">
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card {{ $product->stock == 0 ? 'out-of-stock-card' : '' }}" data-category="{{ $product->category }}">
                        <div class="product-image">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img-front">
                            @if($product->back_image)
                                <img src="{{ asset('storage/' . $product->back_image) }}" alt="{{ $product->name }} - Back" class="product-img-back">
                            @endif
                            <div class="product-hover">
                                <button class="quick-view" data-product-id="{{ $product->id }}">Quick View</button>
                            </div>
                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="stock-badge low-stock">Only {{ $product->stock }} left!</div>
                            @elseif($product->stock == 0)
                                <div class="stock-badge out-of-stock">Out of Stock</div>
                            @endif
                        </div>
                        <div class="product-details">
                            <div class="product-category">{{ ucfirst($product->category) }}</div>
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="product-info">
                                <div class="product-sizes">
                                    <span class="info-label">Sizes:</span>
                                    <span class="info-value">{{ $product->size }}</span>
                                </div>
                                <div class="product-colors">
                                    <span class="info-label">Colors:</span>
                                    <span class="info-value">{{ $product->color }}</span>
                                </div>
                            </div>
                            <p class="product-price">{{ $product->formatted_price }}</p>
                            @if($product->stock > 0)
                                @auth
                                    <button class="add-to-cart" data-product-id="{{ $product->id }}">
                                        <span>Add to Cart</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                                            <circle cx="9" cy="20" r="1"></circle>
                                            <circle cx="20" cy="20" r="1"></circle>
                                        </svg>
                                    </button>
                                @else
                                    <button class="add-to-cart guest-add-to-cart login-required" data-product-id="{{ $product->id }}">
                                        <span>LOGIN TO PURCHASE</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </button>
                                @endauth
                            @else
                                <button class="add-to-cart out-of-stock" disabled>
                                    <span>Out of Stock</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <div class="no-products-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                    </svg>
                    <h3>No Products Found</h3>
                    <p>We couldn't find any products matching your criteria.</p>
                    <a href="{{ route('products') }}" class="btn-primary">View All Products</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
/* Products Hero Section */
.products-hero {
    height: 50vh;
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(255,59,63,0.3)), 
                url('{{ asset("images/products-hero-bg.jpg") }}') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: 80px;
}

.products-hero-content {
    text-align: center;
    color: white;
    z-index: 2;
    position: relative;
}

.products-hero h1 {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
}

.hero-subtitle {
    font-size: 1.3rem;
    font-weight: 300;
    letter-spacing: 2px;
    opacity: 0.9;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 1;
}

/* Filters Section */
.products-filters {
    background: #f8f9fa;
    padding: 2rem 0;
    border-bottom: 1px solid #e9ecef;
}

.filters-wrapper {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-form {
    display: flex;
    align-items: center;
    position: relative;
}

.filter-search-input {
    padding: 0.75rem 1rem;
    padding-right: 3rem;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    font-size: 1rem;
    width: 300px;
    transition: all 0.3s ease;
}

.filter-search-input:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(255, 59, 63, 0.1);
}

.filter-search-btn {
    position: absolute;
    right: 8px;
    background: var(--accent-color);
    border: none;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-search-btn:hover {
    background: #ff6b6b;
    transform: scale(1.05);
}

.results-count {
    font-weight: 500;
    color: #666;
}

/* Products Main Section */
.products-main {
    padding: 4rem 0;
    background: #fff;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 3rem;
    margin-top: 2rem;
    justify-content: center;
}

.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    border: 1px solid rgba(0,0,0,0.05);
    max-width: 400px;
    width: 100%;
    justify-self: center;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.product-image {
    position: relative;
    height: 350px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-img-front,
.product-img-back {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
}

.product-img-back {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
}

.product-card:hover .product-img-back {
    opacity: 1;
}

.product-card:hover .product-img-front {
    opacity: 0;
}

.product-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(255,59,63,0.3));
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(2px);
}

.product-card:hover .product-hover {
    opacity: 1;
}

.quick-view {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: none;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.quick-view:hover {
    background: var(--accent-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 59, 63, 0.4);
}

.stock-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stock-badge.low-stock {
    background: linear-gradient(135deg, #ff9500, #ff6b00);
    color: white;
}

.stock-badge.out-of-stock {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.product-details {
    padding: 2rem;
}

.product-category {
    font-size: 0.8rem;
    color: var(--accent-color);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.product-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.product-info {
    margin-bottom: 1.5rem;
}

.product-info > div {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.info-label {
    font-weight: 600;
    color: #333;
    margin-right: 0.5rem;
    font-size: 0.9rem;
}

.info-value {
    color: #666;
    font-size: 0.9rem;
}

.product-price {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--accent-color);
    margin-bottom: 1.5rem;
}

.add-to-cart {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: white;
    border: none;
    padding: 14px 28px;
    border-radius: 30px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.add-to-cart:hover {
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 59, 63, 0.3);
}

.add-to-cart.login-required {
    background: linear-gradient(135deg, #6c757d, #5a6268);
}

.add-to-cart.login-required:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
}

.add-to-cart.out-of-stock {
    background: #6c757d;
    cursor: not-allowed;
    opacity: 0.6;
}

.add-to-cart.out-of-stock:hover {
    background: #6c757d;
    transform: none;
    box-shadow: none;
}

.add-to-cart svg {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
}

.add-to-cart:hover svg {
    transform: scale(1.1);
}

/* Loading state */
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
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Simple Size Selection Modal */
.size-selection-modal {
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

.size-selection-modal.show {
    opacity: 1;
    visibility: visible;
}

.size-selection-modal .modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
}

.size-selection-modal .modal-content {
    position: relative;
    background: white;
    border-radius: 20px;
    max-width: 450px;
    width: 100%;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    transform: scale(0.9) translateY(-20px);
    transition: all 0.3s ease;
}

.size-selection-modal.show .modal-content {
    transform: scale(1) translateY(0);
}

.size-selection-modal .modal-close {
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

.size-selection-modal .modal-close:hover {
    background: rgba(0, 0, 0, 0.2);
    transform: rotate(90deg);
}

.size-selection-modal .modal-body {
    padding: 40px;
    text-align: center;
}

.size-selection-modal h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 30px;
}

.size-selection-grid {
    margin-bottom: 30px;
}

.size-selection-buttons {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.size-selection-btn {
    padding: 12px 20px;
    border: 2px solid #e5e5e5;
    background: white;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 1rem;
    min-width: 60px;
}

.size-selection-btn:hover {
    border-color: var(--accent-color);
    background: rgba(255, 59, 63, 0.1);
}

.size-selection-btn.active {
    border-color: var(--accent-color);
    background: var(--accent-color);
    color: white;
}

.quantity-selection {
    text-align: center;
}

.quantity-selection label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
    font-size: 1rem;
}

.quantity-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.quantity-btn {
    width: 45px;
    height: 45px;
    border: 2px solid #e5e5e5;
    background: white;
    border-radius: 12px;
    cursor: pointer;
    font-size: 20px;
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

#simpleQuantity {
    width: 70px;
    height: 45px;
    text-align: center;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    font-size: 18px;
    font-weight: 600;
}

#simpleQuantity:focus {
    outline: none;
    border-color: var(--accent-color);
}

.modal-actions {
    text-align: center;
}

.confirm-btn {
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    width: 100%;
}

.confirm-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 59, 63, 0.3);
}

.confirm-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* No Products */
.no-products {
    text-align: center;
    padding: 4rem 2rem;
}

.no-products-content svg {
    color: #ccc;
    margin-bottom: 2rem;
}

.no-products-content h3 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 1rem;
}

.no-products-content p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 2rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-color), #ff6b6b);
    color: white;
    padding: 1rem 2rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 59, 63, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .products-hero {
        height: 40vh;
        margin-top: 70px;
    }
    
    .products-hero h1 {
        font-size: 2.5rem;
    }
    
    .filters-wrapper {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .filter-search-input {
        width: 100%;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 480px) {
    .products-hero h1 {
        font-size: 2rem;
    }
    
    .products-main {
        padding: 2rem 0;
    }
    
    .product-details {
        padding: 1.5rem;
    }
    
    .product-name {
        font-size: 1.1rem;
    }
    
    .product-price {
        font-size: 1.2rem;
    }
    
    .size-selection-modal .modal-content {
        max-width: 350px;
    }
    
    .size-selection-modal .modal-body {
        padding: 30px 20px;
    }
    
    .size-selection-buttons {
        gap: 8px;
    }
    
    .size-selection-btn {
        padding: 10px 16px;
        font-size: 0.9rem;
        min-width: 50px;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    #simpleQuantity {
        width: 60px;
        height: 40px;
        font-size: 16px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality for authenticated users
    const addToCartButtons = document.querySelectorAll('.add-to-cart:not(.guest-add-to-cart)');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (this.classList.contains('login-required') || this.classList.contains('out-of-stock')) {
                return;
            }
            
            const productId = this.dataset.productId;
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-name').textContent;
            const sizesText = productCard.querySelector('.product-sizes .info-value').textContent;
            
            // Check if product has sizes
            if (sizesText && sizesText.trim() !== '' && sizesText.trim() !== '-') {
                // Show size selection modal
                showSizeSelectionModal(productId, productName, sizesText);
            } else {
                // Add to cart without size selection
                addToCartDirectly(productId, productName, '', '');
            }
        });
    });
    
    function addToCartDirectly(productId, productName, size, color) {
        const button = document.querySelector(`[data-product-id="${productId}"]`);
        button.classList.add('loading');
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: 1,
                size: size,
                color: color
            })
        })
        .then(response => response.json())
        .then(data => {
            button.classList.remove('loading');
            
            if (data.success) {
                // Update cart counter with animation
                const cartCounter = document.querySelector('.cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.cart_count;
                    cartCounter.classList.add('updated');
                    setTimeout(() => cartCounter.classList.remove('updated'), 600);
                }
                
                // Show success toast
                showToast('success', 'Added to Cart!', `${productName} has been added to your cart.`);
            } else {
                showToast('error', 'Error!', data.message || 'Failed to add product to cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            button.classList.remove('loading');
            showToast('error', 'Error!', 'Something went wrong. Please try again.');
        });
    }
    
    function showSizeSelectionModal(productId, productName, sizesText) {
        // Remove existing modal if any
        const existingModal = document.getElementById('sizeSelectionModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Parse sizes
        const sizes = sizesText.split(',').map(s => s.trim()).filter(s => s !== '');
        
        // Create simple size selection modal HTML
        const modalHTML = `
            <div id="sizeSelectionModal" class="size-selection-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <button class="modal-close">&times;</button>
                    <div class="modal-body">
                        <h3>Select Size & Quantity</h3>
                        <div class="size-selection-grid">
                            <div class="size-selection-buttons">
                                ${sizes.map(size => `
                                    <button type="button" class="size-selection-btn" data-size="${size}">
                                        ${size}
                                    </button>
                                `).join('')}
                            </div>
                            <div class="quantity-selection">
                                <label>Quantity:</label>
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" id="simpleQuantity" value="1" min="1" max="10">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-actions">
                            <button id="confirmSizeSelection" class="confirm-btn" disabled>Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add modal to page
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // Show modal with animation
        const modal = document.getElementById('sizeSelectionModal');
        setTimeout(() => modal.classList.add('show'), 10);
        
        // Add event listeners
        const closeBtn = modal.querySelector('.modal-close');
        const overlay = modal.querySelector('.modal-overlay');
        const confirmBtn = modal.querySelector('#confirmSizeSelection');
        const sizeButtons = modal.querySelectorAll('.size-selection-btn');
        const quantityInput = modal.querySelector('#simpleQuantity');
        const minusBtn = modal.querySelector('.quantity-btn.minus');
        const plusBtn = modal.querySelector('.quantity-btn.plus');
        
        let selectedSize = '';
        
        // Size selection handlers
        sizeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                sizeButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedSize = this.dataset.size;
                confirmBtn.disabled = false;
            });
        });
        
        // Quantity controls
        minusBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max);
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });
        
        // Confirm selection
        confirmBtn.addEventListener('click', function() {
            if (selectedSize) {
                const quantity = parseInt(quantityInput.value);
                closeSizeSelectionModal();
                addToCartWithQuantity(productId, productName, selectedSize, '', quantity);
            }
        });
        
        // Close modal handlers
        closeBtn.addEventListener('click', closeSizeSelectionModal);
        overlay.addEventListener('click', closeSizeSelectionModal);
        
        // ESC key to close
        const escHandler = function(e) {
            if (e.key === 'Escape') {
                closeSizeSelectionModal();
                document.removeEventListener('keydown', escHandler);
            }
        };
        document.addEventListener('keydown', escHandler);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }
    
    function closeSizeSelectionModal() {
        const modal = document.getElementById('sizeSelectionModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.remove();
                document.body.style.overflow = '';
            }, 300);
        }
    }
    
    function addToCartWithQuantity(productId, productName, size, color, quantity) {
        const button = document.querySelector(`[data-product-id="${productId}"]`);
        if (button) button.classList.add('loading');
        
        fetch('{{ route("cart.add") }}', {
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
            if (button) button.classList.remove('loading');
            
            if (data.success) {
                // Update cart counter with animation
                const cartCounter = document.querySelector('.cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.cart_count;
                    cartCounter.classList.add('updated');
                    setTimeout(() => cartCounter.classList.remove('updated'), 600);
                }
                
                // Show success toast
                const sizeText = size ? ` (Size: ${size})` : '';
                const quantityText = quantity > 1 ? ` x${quantity}` : '';
                showToast('success', 'Added to Cart!', `${productName}${sizeText}${quantityText} has been added to your cart.`);
            } else {
                showToast('error', 'Error!', data.message || 'Failed to add product to cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (button) button.classList.remove('loading');
            showToast('error', 'Error!', 'Something went wrong. Please try again.');
        });
    }
    
    // Handle guest add to cart - show login notification
    const guestAddToCartButtons = document.querySelectorAll('.guest-add-to-cart');
    
    guestAddToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productName = this.closest('.product-card').querySelector('.product-name').textContent;
            showLoginModal(productName);
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
                            <a href="{{ route('register') }}" class="btn-register">Daftar Sekarang</a>
                            <a href="{{ route('login') }}" class="btn-login">Sudah Punya Akun? Login</a>
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
});

// Toast styles
const toastStyles = `
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

/* Login Modal Styles */
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
`;

// Add toast styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = toastStyles;
document.head.appendChild(styleSheet);
</script>
@endpush