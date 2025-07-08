@extends('layouts.app')

@section('title', 'Products - EnthusiastVerse')

@section('content')
<section class="products" id="products" style="margin-top: 100px;">
    <h2 class="section-title">Our Collection</h2>
    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                <div class="product-image">
<<<<<<< HEAD
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="{{ $product->id }}">Quick View</button>
                    </div>
=======
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-hover">
                        <button class="quick-view" data-product-id="{{ $product->id }}">Quick View</button>
                    </div>  
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
                </div>
                <div class="product-details">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-price">{{ $product->formatted_price }}</p>
<<<<<<< HEAD
                    <button class="add-to-cart" data-product-id="{{ $product->id }}">
                        <span>Add to Cart</span>
                        <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                    </button>
=======
                    @auth
                        <button class="add-to-cart" data-product-id="{{ $product->id }}">
                            <span>Add to Cart</span>
                            <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="add-to-cart" style="opacity:0.6; pointer-events:auto; cursor:not-allowed; display:inline-flex; align-items:center; justify-content:center;">
                            <span>Add to Cart</span>
                            <svg viewBox="0 0 12 12"><path d="M10.7 3.3c-.4-.4-1-.4-1.4 0L5 7.6 1.7 4.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l4 4c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4z"/></svg>
                        </a>
                    @endauth
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
<<<<<<< HEAD
=======

<!-- Quick View Modal -->
<div id="quickViewModal" class="quick-view-modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-body">
            <div class="product-image-section">
                <img id="modalProductImage" src="" alt="Product Image">
            </div>
            <div class="product-info-section">
                <h2 id="modalProductName">Product Name</h2>
                <p id="modalProductCategory" class="product-category">Category</p>
                <p id="modalProductPrice" class="product-price">Price</p>
                <div class="product-description">
                    <h4>Description</h4>
                    <p id="modalProductDescription">Product description will appear here.</p>
                </div>
                <div class="product-options">
                    <div class="size-options">
                        <h4>Size</h4>
                        <div id="modalProductSizes" class="size-buttons">
                            <!-- Size buttons will be populated here -->
                        </div>
                    </div>
                    <div class="color-options">
                        <h4>Color</h4>
                        <div id="modalProductColors" class="color-buttons">
                            <!-- Color buttons will be populated here -->
                        </div>
                    </div>
                    <div class="quantity-section">
                        <h4>Quantity</h4>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus">-</button>
                            <input type="number" id="modalQuantity" value="1" min="1" max="10">
                            <button type="button" class="quantity-btn plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="modal-actions">
                    <button id="modalAddToCart" class="add-to-cart-btn">
                        <span>Add to Cart</span>
                    </button>
                    <p id="modalStockInfo" class="stock-info">In Stock</p>
                </div>
            </div>
        </div>
    </div>
</div>
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
<<<<<<< HEAD
=======

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
    font-size: 24px;
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

.product-image-section img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.product-info-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.product-info-section h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.product-category {
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0;
}

.product-info-section .product-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2563eb;
    margin: 0;
}

.product-description h4,
.product-options h4 {
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
    border-color: #2563eb;
    background: #2563eb;
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
    border-color: #2563eb;
    background: #2563eb;
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
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
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
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
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

.stock-info {
    color: #10b981;
    font-weight: 600;
    margin: 0;
    text-align: center;
}

.stock-info.out-of-stock {
    color: #ef4444;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modal-content {
        margin: 10px;
        max-height: 95vh;
    }
    
    .modal-body {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 20px;
    }
    
    .product-image-section img {
        height: 300px;
    }
    
    .product-info-section h2 {
        font-size: 1.5rem;
    }
}
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
<<<<<<< HEAD
=======
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
    modalClose.addEventListener('click', closeQuickView);
    modalOverlay.addEventListener('click', closeQuickView);
    
    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && quickViewModal.classList.contains('show')) {
            closeQuickView();
        }
    });
    
    // Quantity controls
    const quantityInput = document.getElementById('modalQuantity');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    
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
    
    // Modal Add to Cart functionality
    const modalAddToCartBtn = document.getElementById('modalAddToCart');
    modalAddToCartBtn.addEventListener('click', function() {
        if (currentProductId) {
            const quantity = parseInt(quantityInput.value);
            addToCartFromModal(currentProductId, quantity);
        }
    });
    
    function openQuickView(productId) {
        currentProductId = productId;
        
        // Show loading state
        quickViewModal.classList.add('show');
        document.body.style.overflow = 'hidden';
        
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
        document.getElementById('modalProductImage').src = product.image;
        document.getElementById('modalProductImage').alt = product.name;
        document.getElementById('modalProductName').textContent = product.name;
        document.getElementById('modalProductCategory').textContent = product.category;
        document.getElementById('modalProductPrice').textContent = product.formatted_price;
        document.getElementById('modalProductDescription').textContent = product.description;
        
        // Update stock info
        const stockInfo = document.getElementById('modalStockInfo');
        if (product.stock > 0) {
            stockInfo.textContent = `${product.stock} in stock`;
            stockInfo.classList.remove('out-of-stock');
            modalAddToCartBtn.disabled = false;
        } else {
            stockInfo.textContent = 'Out of stock';
            stockInfo.classList.add('out-of-stock');
            modalAddToCartBtn.disabled = true;
        }
        
        // Update quantity input max value
        quantityInput.max = Math.min(product.stock, 10);
        quantityInput.value = 1;
        
        // Populate size options
        const sizesContainer = document.getElementById('modalProductSizes');
        sizesContainer.innerHTML = '';
        if (product.size) {
            const sizes = product.size.split(', ');
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
            const colors = product.color.split(', ');
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
        quickViewModal.classList.remove('show');
        document.body.style.overflow = '';
        currentProductId = null;
    }
    
    function addToCartFromModal(productId, quantity) {
        modalAddToCartBtn.classList.add('loading');
        
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
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
                showToast('success', 'Added to Cart!', `${productName} has been added to your cart.`);
                
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
    
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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