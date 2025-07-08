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
<<<<<<< HEAD
=======
                <li><a href="{{ route('checkout.track') }}">Track Order</a></li>
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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

<<<<<<< HEAD
=======
            <!-- User Authentication -->
            @auth
                <div class="user-menu">
                    <button class="user-menu-toggle" id="userMenuToggle">
                        <div class="user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <span class="user-name">{{ auth()->check() ? auth()->user()->name : 'User' }}</span>
                        <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6,9 12,15 18,9"></polyline>
                        </svg>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profile
                        </a>
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                            </svg>
                            Dashboard
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-form">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16,17 21,12 16,7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link login-link">Login</a>
                    <a href="{{ route('register') }}" class="auth-link register-link">Register</a>
                </div>
            @endauth

>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
<<<<<<< HEAD
        </ul>
=======
            <li><a href="{{ route('checkout.track') }}">Track Order</a></li>
        </ul>
        
        <!-- Mobile Authentication -->
        @auth
            <div class="mobile-user-section">
                <div class="mobile-user-info">
                    <div class="mobile-user-avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <span class="mobile-user-name">{{ auth()->check() ? auth()->user()->name : 'User' }}</span>
                </div>
                <div class="mobile-user-links">
                    <a href="{{ route('profile.edit') }}" class="mobile-auth-link">Profile</a>
                    <a href="{{ route('dashboard') }}" class="mobile-auth-link">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                        @csrf
                        <button type="submit" class="mobile-auth-link logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <div class="mobile-auth-section">
                <a href="{{ route('login') }}" class="mobile-auth-link">Login</a>
                <a href="{{ route('register') }}" class="mobile-auth-link">Register</a>
            </div>
        @endauth
        
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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

<<<<<<< HEAD
=======
/* Authentication Styles */
.auth-links {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.auth-link {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.login-link {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.3);
}

.login-link:hover {
    background: rgba(255,255,255,0.1);
    border-color: #FF3B3F;
    color: #FF3B3F;
}

.register-link {
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    border: 1px solid #FF3B3F;
}

.register-link:hover {
    background: linear-gradient(135deg, #e63946, #d62d20);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 59, 63, 0.3);
}

/* User Menu Styles */
.user-menu {
    position: relative;
}

.user-menu-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 8px 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.user-menu-toggle:hover {
    background: rgba(255,255,255,0.15);
    border-color: #FF3B3F;
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.user-name {
    font-weight: 500;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dropdown-arrow {
    transition: transform 0.3s ease;
}

.user-menu-toggle.active .dropdown-arrow {
    transform: rotate(180deg);
}

.user-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    min-width: 200px;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.user-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: #1a1a1a;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #f8f9fa;
}

.dropdown-item:first-child {
    border-radius: 12px 12px 0 0;
}

.dropdown-item:last-child {
    border-radius: 0 0 12px 12px;
}

.dropdown-divider {
    height: 1px;
    background: #e5e5e5;
    margin: 8px 0;
}

.dropdown-form {
    margin: 0;
}

.logout-btn {
    color: #dc2626 !important;
}

.logout-btn:hover {
    background: #fef2f2 !important;
}

>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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

<<<<<<< HEAD
=======
/* Mobile Authentication Styles */
.mobile-auth-section,
.mobile-user-section {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 1rem;
    margin-top: 1rem;
}

.mobile-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 1rem;
}

.mobile-user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.mobile-user-name {
    color: white;
    font-weight: 600;
    font-size: 16px;
}

.mobile-user-links {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.mobile-auth-link {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    transition: color 0.3s ease;
    background: none;
    border: none;
    text-align: left;
    cursor: pointer;
    width: 100%;
}

.mobile-auth-link:hover {
    color: #FF3B3F;
}

.mobile-logout-form {
    margin: 0;
}

.mobile-auth-section {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
<<<<<<< HEAD
        gap: 2.5rem;
=======
        gap: 2rem;
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
    }
    
    .search-container {
        width: 200px;
    }
}

@media (max-width: 1024px) {
    .nav-links {
<<<<<<< HEAD
        gap: 2rem;
=======
        gap: 1.5rem;
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
    }
    
    .search-container {
        width: 180px;
    }
    
    .nav-links a {
        font-size: 15px;
    }
<<<<<<< HEAD
=======
    
    .user-name {
        display: none;
    }
    
    .auth-links {
        gap: 0.5rem;
    }
    
    .auth-link {
        padding: 6px 12px;
        font-size: 13px;
    }
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
}

@media (max-width: 900px) {
    .nav-links {
<<<<<<< HEAD
        gap: 1.5rem;
=======
        gap: 1.2rem;
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
    
<<<<<<< HEAD
=======
    .auth-links,
    .user-menu {
        display: none;
    }
    
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
    
<<<<<<< HEAD
=======
    // User menu functionality
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdown = document.getElementById('userDropdown');
    
    if (userMenuToggle && userDropdown) {
        userMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
            userMenuToggle.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
                userMenuToggle.classList.remove('active');
            }
        });
    }
    
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
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
<<<<<<< HEAD
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
=======
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a, .mobile-auth-link');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (this.type !== 'submit') { // Don't close for logout button
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
        });
    });
});
</script>