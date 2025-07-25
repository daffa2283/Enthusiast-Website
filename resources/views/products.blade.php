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
                            <img src="{{ \App\Helpers\ImageHelper::getProductImageUrl($product->image) }}" alt="{{ $product->name }}" class="product-img-front" onerror="this.src='{{ asset('images/MOCKUP DEPAN.jpeg.jpg') }}'">
                            @if($product->back_image)
                                <img src="{{ \App\Helpers\ImageHelper::getProductImageUrl($product->back_image) }}" alt="{{ $product->name }} - Back" class="product-img-back" onerror="this.src='{{ asset('images/MOCKUP BELAKANG.jpeg.jpg') }}'">
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

<!-- Quick View Modal -->
<div id="quickViewModal" class="quick-view-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <button class="modal-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="modal-body">
            <div class="product-image-section">
                <div class="image-slider">
                    <div class="slider-container">
                        <div class="slider-track" id="modalSliderTrack">
                            <div class="slide active">
                                <img id="modalProductImageFront" src="" alt="Product Image - Front">
                            </div>
                            <div class="slide">
                                <img id="modalProductImageBack" src="" alt="Product Image - Back">
                            </div>
                        </div>
                    </div>
                    <button class="slider-arrow slider-arrow-left" id="modalSliderPrev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15,18 9,12 15,6"></polyline>
                        </svg>
                    </button>
                    <button class="slider-arrow slider-arrow-right" id="modalSliderNext">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9,18 15,12 9,6"></polyline>
                        </svg>
                    </button>
                    <div class="slider-dots">
                        <span class="dot active" data-slide="0"></span>
                        <span class="dot" data-slide="1"></span>
                    </div>
                </div>
            </div>
            <div class="product-info-section">
                <div class="product-header">
                    <div class="product-badge">
                        <span id="modalProductCategory" class="category-badge">Category</span>
                    </div>
                    <h2 id="modalProductName">Product Name</h2>
                    <div class="price-container">
                        <span id="modalProductPrice" class="product-price">Price</span>
                        <div class="stock-indicator">
                            <div class="stock-dot"></div>
                            <span id="modalStockInfo" class="stock-text">In Stock</span>
                        </div>
                    </div>
                </div>

                <div class="product-description">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10,9 9,9 8,9"></polyline>
                        </svg>
                        Description
                    </h4>
                    <div id="modalProductDescription" class="description-content">Product description will appear here.</div>
                </div>

                <div class="product-options">
                    <div class="size-options">
                        <h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="9" cy="9" r="2"></circle>
                                <path d="M21 15.5c-.3-1.1-1.2-2-2.4-2.5"></path>
                            </svg>
                            Size
                        </h4>
                        <div id="modalProductSizes" class="size-buttons">
                            <!-- Size buttons will be populated here -->
                        </div>
                    </div>
                    <div class="color-options">
                        <h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M12 1v6m0 6v6m11-7h-6m-6 0H1m15.5-6.5l-4.24 4.24M7.76 7.76L3.52 3.52m12.96 12.96l-4.24-4.24M7.76 16.24l-4.24 4.24"></path>
                            </svg>
                            Color
                        </h4>
                        <div id="modalProductColors" class="color-buttons">
                            <!-- Color buttons will be populated here -->
                        </div>
                    </div>
                    <div class="quantity-section">
                        <h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                            Quantity
                        </h4>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                            <input type="number" id="modalQuantity" value="1" min="1" max="10">
                            <button type="button" class="quantity-btn plus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    @auth
                        <button id="modalAddToCart" class="add-to-cart-btn primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                                <circle cx="9" cy="20" r="1"></circle>
                                <circle cx="20" cy="20" r="1"></circle>
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    @else
                        <button id="modalAddToCart" class="add-to-cart-btn guest-modal-add-to-cart">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>LOGIN TO ADD TO CART</span>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Products Hero Section */
.products-hero {
    height: 50vh;
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(44,62,80,0.3)), 
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
    box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
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
    background: #507191;
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
    background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(44,62,80,0.3));
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
    box-shadow: 0 6px 20px rgba(44, 62, 80, 0.4);
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
    background: linear-gradient(135deg, var(--accent-color), #507191);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
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
    background: linear-gradient(135deg, var(--accent-color), #507191);
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
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
}

/* Quick View Modal Styles */
.quick-view-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.quick-view-modal.show {
    display: flex;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 20px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.1);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: rgba(0, 0, 0, 0.2);
    transform: rotate(90deg);
}

.modal-body {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    padding: 40px;
}

.product-image-section {
    position: relative;
}

.image-slider {
    position: relative;
    width: 100%;
    height: 400px;
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

.product-info-section {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.product-header {
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 20px;
}

.product-badge {
    margin-bottom: 12px;
}

.category-badge {
    background: linear-gradient(135deg, var(--accent-color), #507191);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
}

.product-info-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 15px 0;
    line-height: 1.2;
}

.price-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}

.product-info-section .product-price {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-color);
    margin: 0;
}

.stock-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(16, 185, 129, 0.1);
    border-radius: 20px;
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.stock-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #10b981;
    animation: pulse 2s infinite;
}

.stock-indicator.out-of-stock {
    background: rgba(239, 68, 68, 0.1);
    border-color: rgba(239, 68, 68, 0.2);
}

.stock-indicator.out-of-stock .stock-dot {
    background: #ef4444;
}

.stock-text {
    font-size: 0.9rem;
    font-weight: 600;
    color: #10b981;
    margin: 0;
}

.stock-indicator.out-of-stock .stock-text {
    color: #ef4444;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.product-description {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid var(--accent-color);
}

.product-description h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-description h4 svg {
    color: var(--accent-color);
}

.product-description p {
    color: #666;
    line-height: 1.6;
    margin: 0;
    font-size: 0.95rem;
}

/* Description Content Styling for Modal */
.description-content {
    color: #666;
    line-height: 1.6;
    font-size: 0.95rem;
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

.product-options h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-options h4 svg {
    color: var(--accent-color);
}

.product-options {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.size-buttons,
.color-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.size-buttons button,
.color-buttons button {
    padding: 8px 16px;
    border: 2px solid #e5e5e5;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.size-buttons button:hover,
.color-buttons button:hover,
.size-buttons button.active,
.color-buttons button.active {
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

#modalQuantity {
    width: 80px;
    height: 40px;
    text-align: center;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
}

.modal-actions {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, var(--accent-color), #507191);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(44, 62, 80, 0.3);
}

.add-to-cart-btn.guest-modal-add-to-cart {
    background: linear-gradient(135deg, #6B7280, #4B5563) !important;
    border: 2px solid #9CA3AF;
}

.add-to-cart-btn.guest-modal-add-to-cart:hover {
    background: linear-gradient(135deg, #4B5563, #374151) !important;
    border-color: #6B7280;
}

/* Out of Stock Button Styling */
.add-to-cart-btn.out-of-stock-btn {
    background: #6c757d !important;
    color: white !important;
    cursor: not-allowed !important;
    opacity: 0.7 !important;
    border: 2px solid #6c757d !important;
}

.add-to-cart-btn.out-of-stock-btn:hover {
    background: #6c757d !important;
    transform: none !important;
    box-shadow: none !important;
    border-color: #6c757d !important;
}

.add-to-cart-btn.out-of-stock-btn:disabled {
    background: #6c757d !important;
    color: white !important;
    cursor: not-allowed !important;
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
    
    .results-count {
        text-align: center;
    }
    
    .products-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    /* Mobile Quick View Button - Touch activated */
    .product-card.mobile-touched .product-hover {
        opacity: 1 !important;
        background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(44,62,80,0.3)) !important;
    }
    
    .product-card.mobile-touched .quick-view {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        padding: 10px 24px !important;
        font-size: 0.85rem !important;
        border-radius: 25px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15) !important;
        position: relative;
        z-index: 10;
    }
    
    .product-card.mobile-touched .quick-view:hover {
        background: var(--accent-color) !important;
        color: white !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3) !important;
    }
    
    .modal-body {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 20px;
    }
    
    .image-slider {
        height: 300px;
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
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick View functionality
    const quickViewButtons = document.querySelectorAll('.quick-view');
    const quickViewModal = document.getElementById('quickViewModal');
    const modalClose = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');
    let currentProductId = null;
    
    // Quick View button click handlers
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            openQuickView(productId);
        });
    });
    
    // Modal close handlers
    if (modalClose) modalClose.addEventListener('click', closeQuickView);
    if (modalOverlay) modalOverlay.addEventListener('click', closeQuickView);
    
    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && quickViewModal && quickViewModal.classList.contains('show')) {
            closeQuickView();
        }
    });
    
    // Quantity controls
    const quantityInput = document.getElementById('modalQuantity');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    
    if (minusBtn) {
        minusBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    }
    
    if (plusBtn) {
        plusBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max);
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });
    }
    
    // Modal Add to Cart functionality
    const modalAddToCartBtn = document.getElementById('modalAddToCart');
    if (modalAddToCartBtn) {
        modalAddToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Modal button clicked!'); // Debug log
            console.log('Button classes:', this.classList); // Debug log
            
            if (this.classList.contains('guest-modal-add-to-cart')) {
                console.log('Guest user detected, showing login modal'); // Debug log
                // Show login modal for guests (regardless of stock status)
                const productName = document.getElementById('modalProductName').textContent;
                showLoginModal(productName);
                closeQuickView();
            } else if (currentProductId && !this.disabled) {
                console.log('Authenticated user, adding to cart'); // Debug log
                const quantity = parseInt(quantityInput.value);
                addToCartFromModal(currentProductId, quantity);
            } else {
                console.log('Button disabled or no product ID'); // Debug log
            }
        });
    } else {
        console.log('Modal add to cart button not found!'); // Debug log
    }
    
    function openQuickView(productId) {
        currentProductId = productId;
        
        // Show loading state
        if (quickViewModal) {
            quickViewModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        
        // Fetch product data
        fetch(`/product/quick-view/${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    populateModal(data.product);
                } else {
                    showToast('error', 'Error!', 'Failed to load product details.');
                    closeQuickView();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Error!', 'Failed to load product details.');
                closeQuickView();
            });
    }
    
    function populateModal(product) {
        // Update product information
        document.getElementById('modalProductImageFront').src = product.image;
        document.getElementById('modalProductImageFront').alt = product.name + ' - Front';
        
        // Set back image or use front image as fallback
        const backImageElement = document.getElementById('modalProductImageBack');
        if (product.back_image) {
            backImageElement.src = product.back_image;
            backImageElement.alt = product.name + ' - Back';
        } else {
            backImageElement.src = product.image;
            backImageElement.alt = product.name + ' - Back';
        }
        
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductCategory').textContent = product.category;
        document.getElementById('modalProductPrice').textContent = product.formatted_price;
        document.getElementById('modalProductDescription').innerHTML = product.description || '<p>High-quality product crafted with attention to detail and premium materials.</p>';
        
        // Reset slider to first slide
        resetSlider();
        
        // Update stock info and button based on stock status
        const stockInfo = document.getElementById('modalStockInfo');
        const stockIndicator = document.querySelector('.stock-indicator');
        const modalButtonSpan = modalAddToCartBtn.querySelector('span');
        const modalButtonSvg = modalAddToCartBtn.querySelector('svg');
        
        if (product.stock > 0) {
            // Product is in stock
            stockInfo.textContent = `${product.stock} in stock`;
            stockIndicator.classList.remove('out-of-stock');
            modalAddToCartBtn.disabled = false;
            modalAddToCartBtn.classList.remove('out-of-stock-btn');
            
            // Reset button text and icon for in-stock products
            @auth
                modalButtonSpan.textContent = 'Add to Cart';
                modalButtonSvg.innerHTML = `
                    <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                    <circle cx="9" cy="20" r="1"></circle>
                    <circle cx="20" cy="20" r="1"></circle>
                `;
            @else
                modalButtonSpan.textContent = 'LOGIN TO ADD TO CART';
                modalButtonSvg.innerHTML = `
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                `;
            @endauth
        } else {
            // Product is out of stock
            stockInfo.textContent = 'Out of stock';
            stockIndicator.classList.add('out-of-stock');
            modalAddToCartBtn.disabled = true;
            modalAddToCartBtn.classList.add('out-of-stock-btn');
            
            // Change button text and icon for out-of-stock products
            modalButtonSpan.textContent = 'Out of Stock';
            modalButtonSvg.innerHTML = `
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            `;
        }
        
        // Update quantity input max value
        quantityInput.max = Math.min(product.stock || 1, 10);
        quantityInput.value = 1;
        
        // Disable quantity controls for out-of-stock products
        const quantityControls = document.querySelectorAll('.quantity-btn, #modalQuantity');
        quantityControls.forEach(control => {
            if (product.stock <= 0) {
                control.disabled = true;
                control.style.opacity = '0.5';
                control.style.cursor = 'not-allowed';
            } else {
                control.disabled = false;
                control.style.opacity = '1';
                control.style.cursor = 'pointer';
            }
        });
        
        // Disable size and color options for out-of-stock products
        const optionButtons = document.querySelectorAll('.size-buttons button, .color-buttons button');
        optionButtons.forEach(button => {
            if (product.stock <= 0) {
                button.disabled = true;
                button.style.opacity = '0.5';
                button.style.cursor = 'not-allowed';
            } else {
                button.disabled = false;
                button.style.opacity = '1';
                button.style.cursor = 'pointer';
            }
        });
        
        // Populate size options
        const sizesContainer = document.getElementById('modalProductSizes');
        sizesContainer.innerHTML = '';
        if (product.size) {
            const sizes = product.size.split(',');
            sizes.forEach((size, index) => {
                const sizeBtn = document.createElement('button');
                sizeBtn.textContent = size.trim();
                sizeBtn.type = 'button';
                if (index === 0) sizeBtn.classList.add('active');
                sizeBtn.addEventListener('click', function() {
                    sizesContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
                sizesContainer.appendChild(sizeBtn);
            });
        }
        
        // Populate color options
        const colorsContainer = document.getElementById('modalProductColors');
        colorsContainer.innerHTML = '';
        if (product.color) {
            const colors = product.color.split(',');
            colors.forEach((color, index) => {
                const colorBtn = document.createElement('button');
                colorBtn.textContent = color.trim();
                colorBtn.type = 'button';
                if (index === 0) colorBtn.classList.add('active');
                colorBtn.addEventListener('click', function() {
                    colorsContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
                colorsContainer.appendChild(colorBtn);
            });
        }
    }
    
    function closeQuickView() {
        if (quickViewModal) {
            quickViewModal.classList.remove('show');
            document.body.style.overflow = '';
            currentProductId = null;
        }
    }
    
    function addToCartFromModal(productId, quantity) {
        // Get selected size and color
        const selectedSize = document.querySelector('#modalProductSizes button.active')?.textContent.trim() || '';
        const selectedColor = document.querySelector('#modalProductColors button.active')?.textContent.trim() || '';
        
        // Check if size is required and selected
        const sizesContainer = document.getElementById('modalProductSizes');
        const hasSizes = sizesContainer && sizesContainer.children.length > 0;
        
        if (hasSizes && !selectedSize) {
            // Show error message for missing size selection
            showToast('error', 'Size Required!', 'Please select a size before adding to cart.');
            return;
        }
        
        modalAddToCartBtn.classList.add('loading');
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
                size: selectedSize,
                color: selectedColor
            })
        })
        .then(response => response.json())
        .then(data => {
            modalAddToCartBtn.classList.remove('loading');
            
            if (data.success) {
                // Update cart counter
                const cartCounter = document.querySelector('.cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.cart_count;
                    cartCounter.classList.add('updated');
                    setTimeout(() => cartCounter.classList.remove('updated'), 600);
                }
                
                // Show success toast
                const productName = document.getElementById('modalProductName').textContent;
                const sizeText = selectedSize ? ` (Size: ${selectedSize})` : '';
                showToast('success', 'Added to Cart!', `${productName}${sizeText} has been added to your cart.`);
                
                // Close modal after short delay
                setTimeout(() => {
                    closeQuickView();
                }, 1000);
            } else {
                showToast('error', 'Error!', data.message || 'Failed to add product to cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalAddToCartBtn.classList.remove('loading');
            showToast('error', 'Error!', 'Something went wrong. Please try again.');
        });
    }
    
    // Add to cart functionality for authenticated users - redirect to quick view
    const addToCartButtons = document.querySelectorAll('.add-to-cart:not(.guest-add-to-cart)');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (this.classList.contains('login-required') || this.classList.contains('out-of-stock')) {
                return;
            }
            
            const productId = this.dataset.productId;
            // Always open quick view modal for size and quantity selection
            openQuickView(productId);
        });
    });
    
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
    
    // Image Slider Functionality
    let currentSlide = 0;
    const totalSlides = 2;
    
    const sliderTrack = document.getElementById('modalSliderTrack');
    const prevBtn = document.getElementById('modalSliderPrev');
    const nextBtn = document.getElementById('modalSliderNext');
    const dots = document.querySelectorAll('.slider-dots .dot');
    
    function updateSlider() {
        const translateX = -currentSlide * 50;
        sliderTrack.style.transform = `translateX(${translateX}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
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
    
    function resetSlider() {
        currentSlide = 0;
        updateSlider();
    }
    
    // Event listeners for slider controls
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => goToSlide(index));
    });
});

// Add toast styles
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
    background: linear-gradient(135deg, var(--accent-color), #507191);
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
    box-shadow: 0 10px 25px rgba(44, 62, 80, 0.3);
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
    color: var(--accent-color);
    text-decoration: none;
}
`;

// Add toast styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = toastStyles;
document.head.appendChild(styleSheet);

// Mobile touch handling for quick view button
function initMobileTouchHandling() {
    // Check if device is mobile
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            let touchTimeout;
            
            // Touch start event
            card.addEventListener('touchstart', function(e) {
                // Clear any existing timeout
                clearTimeout(touchTimeout);
                
                // Add touched class immediately
                this.classList.add('mobile-touched');
                
                // Set timeout to remove class if touch is held too long
                touchTimeout = setTimeout(() => {
                    this.classList.remove('mobile-touched');
                }, 3000); // Remove after 3 seconds
            }, { passive: true });
            
            // Touch end event
            card.addEventListener('touchend', function(e) {
                // Clear timeout
                clearTimeout(touchTimeout);
                
                // Remove touched class after a short delay
                setTimeout(() => {
                    this.classList.remove('mobile-touched');
                }, 2000); // Keep visible for 2 seconds after touch end
            }, { passive: true });
            
            // Touch cancel event (when touch is interrupted)
            card.addEventListener('touchcancel', function(e) {
                clearTimeout(touchTimeout);
                this.classList.remove('mobile-touched');
            }, { passive: true });
            
            // Remove touched class when scrolling
            let isScrolling = false;
            window.addEventListener('scroll', function() {
                if (!isScrolling) {
                    isScrolling = true;
                    card.classList.remove('mobile-touched');
                    setTimeout(() => {
                        isScrolling = false;
                    }, 100);
                }
            }, { passive: true });
        });
    }
}

// Initialize mobile touch handling when DOM is loaded
document.addEventListener('DOMContentLoaded', initMobileTouchHandling);

// Re-initialize on window resize
window.addEventListener('resize', function() {
    // Remove all mobile-touched classes first
    document.querySelectorAll('.product-card.mobile-touched').forEach(card => {
        card.classList.remove('mobile-touched');
    });
    
    // Re-initialize if now mobile
    initMobileTouchHandling();
});
</script>
@endpush