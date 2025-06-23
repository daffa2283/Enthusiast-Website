@extends('layouts.app')

@section('title', 'Search Results - EnthusiastVerse')

@push('styles')
<style>
.search-results-container {
    margin-top: 100px;
    padding: 2rem 1rem;
    min-height: 70vh;
}

.search-results-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.search-header {
    text-align: center;
    margin-bottom: 3rem;
}

.search-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.search-subtitle {
    color: #666;
    font-size: 1.1rem;
}

.search-query {
    color: #FF3B3F;
    font-weight: 600;
}

.search-stats {
    background: #f8f9fa;
    padding: 1rem 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.results-count {
    font-weight: 600;
    color: #1a1a1a;
}

.search-filters {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.filter-select {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: white;
    font-size: 0.9rem;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.no-results {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.no-results-icon {
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

.no-results-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.no-results-text {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.search-suggestions-list {
    margin-top: 2rem;
    text-align: left;
}

.search-suggestions-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.suggestion-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.suggestion-tag {
    background: #f8f9fa;
    color: #666;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.suggestion-tag:hover {
    background: #FF3B3F;
    color: white;
    border-color: #FF3B3F;
}

.back-to-products {
    text-align: center;
    margin-top: 2rem;
}

.back-to-products a {
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

.back-to-products a:hover {
    background: linear-gradient(135deg, #333, #1a1a1a);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(26, 26, 26, 0.3);
    color: white;
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

/* Responsive Design */
@media (max-width: 768px) {
    .search-stats {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }
    
    .search-filters {
        justify-content: center;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .search-title {
        font-size: 2rem;
    }
}
</style>
@endpush

@section('content')
<section class="search-results-container">
    <div class="search-results-wrapper">
        <div class="search-header">
            <h1 class="search-title">Search Results</h1>
            @if($query)
                <p class="search-subtitle">
                    Showing results for "<span class="search-query">{{ $query }}</span>"
                </p>
            @endif
        </div>
        
        @if($query && $products->count() > 0)
            <div class="search-stats">
                <div class="results-count">
                    Found {{ $products->count() }} {{ Str::plural('product', $products->count()) }}
                </div>
                <div class="search-filters">
                    <select class="filter-select" id="sortFilter">
                        <option value="relevance">Sort by Relevance</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                    </select>
                </div>
            </div>
            
            <div class="products-grid" id="productsGrid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
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
                @endforeach
            </div>
        @else
            <div class="no-results">
                <div class="no-results-icon">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </div>
                <h3 class="no-results-title">
                    @if($query)
                        No products found
                    @else
                        Start your search
                    @endif
                </h3>
                <p class="no-results-text">
                    @if($query)
                        We couldn't find any products matching "<strong>{{ $query }}</strong>". Try different keywords or browse our categories.
                    @else
                        Enter a search term to find products you're looking for.
                    @endif
                </p>
                
                @if($query)
                    <div class="search-suggestions-list">
                        <h4 class="search-suggestions-title">Try searching for:</h4>
                        <div class="suggestion-tags">
                            <a href="{{ route('search', ['q' => 'hoodie']) }}" class="suggestion-tag">Hoodie</a>
                            <a href="{{ route('search', ['q' => 't-shirt']) }}" class="suggestion-tag">T-Shirt</a>
                            <a href="{{ route('search', ['q' => 'sweatshirt']) }}" class="suggestion-tag">Sweatshirt</a>
                            <a href="{{ route('search', ['q' => 'black']) }}" class="suggestion-tag">Black</a>
                            <a href="{{ route('search', ['q' => 'essential']) }}" class="suggestion-tag">Essential</a>
                            <a href="{{ route('search', ['q' => 'premium']) }}" class="suggestion-tag">Premium</a>
                        </div>
                    </div>
                @endif
                
                <div class="back-to-products">
                    <a href="{{ route('products') }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm8 13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h4v1a1 1 0 0 0 2 0V9h2v10z"/>
                        </svg>
                        Browse All Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartCounter = document.querySelector('#cartCounter');
    
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
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                // Remove loading state
                this.classList.remove('loading');
                
                if (data.success) {
                    // Update cart counter with animation
                    if (cartCounter) {
                        cartCounter.textContent = data.cart_count;
                        cartCounter.classList.add('updated');
                        setTimeout(() => cartCounter.classList.remove('updated'), 600);
                    }
                    
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
                
                // Show error toast
                showToast('error', 'Error!', 'Something went wrong. Please try again.');
            });
        });
    });
    
    // Sort functionality
    const sortFilter = document.getElementById('sortFilter');
    const productsGrid = document.getElementById('productsGrid');
    
    if (sortFilter && productsGrid) {
        sortFilter.addEventListener('change', function() {
            const sortValue = this.value;
            const products = Array.from(productsGrid.children);
            
            products.sort((a, b) => {
                switch(sortValue) {
                    case 'price_low':
                        return getPrice(a) - getPrice(b);
                    case 'price_high':
                        return getPrice(b) - getPrice(a);
                    case 'name':
                        return getName(a).localeCompare(getName(b));
                    default:
                        return 0;
                }
            });
            
            // Re-append sorted products
            products.forEach(product => productsGrid.appendChild(product));
        });
    }
    
    function getPrice(productCard) {
        const priceText = productCard.querySelector('.product-price').textContent;
        return parseInt(priceText.replace(/[^\d]/g, ''));
    }
    
    function getName(productCard) {
        return productCard.querySelector('.product-name').textContent;
    }
    
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