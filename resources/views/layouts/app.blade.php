<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EnthusiastVerse - Clothing Brand')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <div class="loading-logo">
                <img src="{{ asset('images/logo.png') }}" alt="EnthusiastVerse" class="loading-logo-img">
            </div>
            <div class="loading-spinner">
                <div class="spinner"></div>
            </div>
            <p class="loading-text">Loading EnthusiastVerse...</p>
        </div>
    </div>

    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18,15 12,9 6,15"></polyline>
        </svg>
    </button>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    
    <!-- CSRF Token Auto-Refresh Script -->
    <script>
        // Auto-refresh CSRF token to prevent page expired errors
        function refreshCsrfToken() {
            fetch('/csrf-token', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.csrf_token) {
                    // Update meta tag
                    const metaTag = document.querySelector('meta[name="csrf-token"]');
                    if (metaTag) {
                        metaTag.setAttribute('content', data.csrf_token);
                    }
                    
                    // Update all CSRF input fields
                    document.querySelectorAll('input[name="_token"]').forEach(input => {
                        input.value = data.csrf_token;
                    });
                }
            })
            .catch(error => {
                console.log('CSRF token refresh failed:', error);
            });
        }
        
        // Refresh CSRF token every 30 seconds
        setInterval(refreshCsrfToken, 30000);
        
        // Refresh CSRF token when page becomes visible (user switches back to tab)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                refreshCsrfToken();
            }
        });
        
        // Handle CSRF token mismatch errors globally
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('419')) {
                refreshCsrfToken();
            }
        });
    </script>
    
    @stack('scripts')
    
    <!-- Loading Screen Script -->
    <script>
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            setTimeout(() => {
                loadingScreen.style.opacity = '0';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 1000);
        });
        
        // Back to top functionality
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
