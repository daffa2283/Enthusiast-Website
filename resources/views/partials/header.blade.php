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
                <form action="{{ route('search') }}" method="GET" class="search-form" id="searchForm">
                    <div class="search-input-wrapper">
                        <input type="text" 
                               name="q" 
                               placeholder="Search..." 
                               class="search-input"
                               id="searchInput"
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

            @auth
                <div class="user-menu">
                    <button class="user-menu-toggle" id="userMenuToggle">
                        <div class="user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6,9 12,15 18,9"></polyline>
                        </svg>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                        @if(auth()->user()->isAdmin())
                            <a href="/admin-panel" class="dropdown-item">Admin Panel</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-form" id="logoutForm">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="auth-links">
                    <a href="{{ route('login') }}" class="auth-link login-link">Login</a>
                    <a href="{{ route('register') }}" class="auth-link register-link">Register</a>
                </div>
            @endauth

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <!-- Search moved to top -->
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

        <ul class="mobile-nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('products') }}">Products</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
        </ul>

        @guest
            <div class="mobile-auth-section">
                <a href="{{ route('login') }}" class="mobile-auth-link">Login</a>
                <a href="{{ route('register') }}" class="mobile-auth-link">Register</a>
            </div>
        @endguest
    </div>
</header>
