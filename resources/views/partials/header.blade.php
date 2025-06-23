<header class="header">
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="EnthusiastVerse Logo" class="logo-img">
            </a>
        </div>

        <div class="nav-center">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products') }}">Products</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
            </ul>
        </div>

        <div class="nav-right">
            <div class="search-container">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <div class="search-input-wrapper">
                        <input type="text" 
                               name="q" 
                               placeholder="Search..." 
                               class="search-input"
                               value="{{ request('q') }}"
                               autocomplete="off">
                        <button type="submit" class="search-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                </form>
                <div class="search-suggestions" id="searchSuggestions"></div>
            </div>
            
            <a href="{{ route('cart') }}" class="nav-icon cart-icon">
                <div class="cart-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="cart-svg">
                        <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                        <circle cx="9" cy="20" r="1"></circle>
                        <circle cx="20" cy="20" r="1"></circle>
                    </svg>
                    <span class="cart-counter" id="cartCounter">{{ session('cart_count', 0) }}</span>
                </div>
            </a>

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products') }}">Products</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
        </ul>
        <div class="mobile-search-container">
            <form action="{{ route('search') }}" method="GET" class="mobile-search-form">
                <div class="mobile-search-wrapper">
                    <input type="text" 
                           name="q" 
                           placeholder="Search products..." 
                           class="mobile-search-input"
                           value="{{ request('q') }}">
                    <button type="submit" class="mobile-search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>

<style>
/* Enhanced Header Styles */
.header {
    background: #000;
    padding: 1rem 0;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
}

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    height: 60px;
    min-height: 60px;
}

/* Logo Section */
.nav-left {
    display: flex;
    align-items: center;
    flex: 0 0 auto;
}

.logo {
    display: flex;
    align-items: center;
}

.logo-img {
    height: 45px;
    width: auto;
    transition: transform 0.3s ease;
}

.logo-img:hover {
    transform: scale(1.05);
}

/* Navigation Links - Centered */
.nav-center {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60px;
}

.nav-links {
    display: flex;
    gap: 3rem;
    list-style: none;
    margin: 0;
    padding: 0;
    align-items: center;
    height: 100%;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    position: relative;
    transition: color 0.3s ease;
    padding: 1rem 0;
    white-space: nowrap;
    display: flex;
    align-items: center;
    height: 100%;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #FF3B3F;
    transition: width 0.3s ease;
}

.nav-links a:hover {
    color: #FF3B3F;
}

.nav-links a:hover::after {
    width: 100%;
}

/* Right Section with Search and Cart */
.nav-right {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex: 0 0 auto;
}

/* Search Styles */
.search-container {
    position: relative;
    width: 280px;
}

.search-form {
    width: 100%;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    height: 40px;
}

.search-input-wrapper:focus-within {
    background: rgba(255,255,255,0.15);
    border-color: #FF3B3F;
    box-shadow: 0 0 0 2px rgba(255, 59, 63, 0.1);
}

.search-input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 0 16px;
    color: white;
    font-size: 14px;
    outline: none;
    height: 100%;
}

.search-input::placeholder {
    color: rgba(255,255,255,0.7);
}

.search-btn {
    background: transparent;
    border: none;
    padding: 0 12px;
    color: rgba(255,255,255,0.8);
    cursor: pointer;
    transition: color 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
}

.search-btn:hover {
    color: #FF3B3F;
}

.search-suggestions {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-suggestion {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    align-items: center;
    gap: 12px;
}

.search-suggestion:hover {
    background: #f8f9fa;
}

.search-suggestion:last-child {
    border-bottom: none;
}

.suggestion-image {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 6px;
}

.suggestion-details {
    flex: 1;
}

.suggestion-name {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 2px;
    font-size: 14px;
}

.suggestion-price {
    color: #666;
    font-size: 12px;
}

/* Cart Icon Styles */
.nav-icon {
    color: white;
    text-decoration: none;
    padding: 8px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    background: transparent;
    border: none;
    cursor: pointer;
}

.nav-icon:hover {
    background: rgba(255,255,255,0.1);
    color: #FF3B3F;
}

.cart-icon-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cart-svg {
    width: 24px;
    height: 24px;
}

.cart-counter {
    position: absolute;
    top: -8px;
    right: -8px;
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 600;
    border: 2px solid #000;
    min-width: 20px;
    transition: all 0.3s ease;
}

.cart-counter.updated {
    animation: cartBounce 0.6s ease;
}

@keyframes cartBounce {
    0%, 20%, 60%, 100% {
        transform: scale(1);
    }
    40% {
        transform: scale(1.3);
    }
    80% {
        transform: scale(1.1);
    }
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 8px;
    gap: 3px;
}

.mobile-menu-toggle span {
    width: 20px;
    height: 2px;
    background: white;
    transition: all 0.3s ease;
    border-radius: 1px;
}

.mobile-menu-toggle:hover span {
    background: #FF3B3F;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}

/* Mobile Menu */
.mobile-menu {
    display: none;
    background: #111;
    border-top: 1px solid rgba(255,255,255,0.1);
    padding: 1rem 2rem;
}

.mobile-nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
    margin-bottom: 1rem;
}

.mobile-nav-links li {
    margin-bottom: 0.5rem;
}

.mobile-nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    display: block;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    transition: color 0.3s ease;
}

.mobile-nav-links a:hover {
    color: #FF3B3F;
}

.mobile-search-container {
    margin-top: 1rem;
}

.mobile-search-form {
    width: 100%;
}

.mobile-search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    border: 1px solid rgba(255,255,255,0.2);
    height: 45px;
}

.mobile-search-input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 0 20px;
    color: white;
    font-size: 16px;
    outline: none;
    height: 100%;
}

.mobile-search-input::placeholder {
    color: rgba(255,255,255,0.7);
}

.mobile-search-btn {
    background: transparent;
    border: none;
    padding: 0 15px;
    color: rgba(255,255,255,0.8);
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .nav-links {
        gap: 2.5rem;
    }
    
    .search-container {
        width: 200px;
    }
}

@media (max-width: 1024px) {
    .nav-links {
        gap: 2rem;
    }
    
    .search-container {
        width: 180px;
    }
    
    .nav-links a {
        font-size: 15px;
    }
}

@media (max-width: 900px) {
    .nav-links {
        gap: 1.5rem;
    }
    
    .nav-links a {
        font-size: 14px;
    }
    
    .search-container {
        width: 160px;
    }
}

@media (max-width: 768px) {
    .navbar {
        justify-content: space-between;
    }
    
    .nav-center {
        display: none;
    }
    
    .search-container {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: flex;
    }
    
    .mobile-menu.active {
        display: block;
    }
}

@media (max-width: 480px) {
    .navbar {
        padding: 0 1rem;
    }
    
    .logo-img {
        height: 35px;
    }
}

/* Desktop-only search visibility */
@media (min-width: 769px) {
    .mobile-menu {
        display: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
        });
    }
    
    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const mobileSearchInput = document.querySelector('.mobile-search-input');
    const searchSuggestions = document.querySelector('.search-suggestions');
    
    // Search suggestions
    function setupSearchSuggestions(input, suggestionsContainer) {
        if (!input || !suggestionsContainer) return;
        
        let searchTimeout;
        
        input.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                suggestionsContainer.style.display = 'none';
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetchSearchSuggestions(query, suggestionsContainer);
            }, 300);
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
    }
    
    function fetchSearchSuggestions(query, container) {
        fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySearchSuggestions(data, container);
            })
            .catch(error => {
                console.error('Search error:', error);
            });
    }
    
    function displaySearchSuggestions(suggestions, container) {
        if (!suggestions || suggestions.length === 0) {
            container.style.display = 'none';
            return;
        }
        
        container.innerHTML = suggestions.map(product => `
            <div class="search-suggestion" onclick="window.location.href='{{ route('products') }}?search=${encodeURIComponent(product.name)}'">
                <img src="${product.image}" alt="${product.name}" class="suggestion-image">
                <div class="suggestion-details">
                    <div class="suggestion-name">${product.name}</div>
                    <div class="suggestion-price">${product.formatted_price}</div>
                </div>
            </div>
        `).join('');
        
        container.style.display = 'block';
    }
    
    // Setup search for desktop
    setupSearchSuggestions(searchInput, searchSuggestions);
    
    // Close mobile menu when clicking on links
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        });
    });
});
</script>