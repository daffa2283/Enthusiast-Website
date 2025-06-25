<footer class="dark-footer">
    <div class="footer-container">
        <div class="footer-brand">
            <h3>EnthusiastVerse</h3>
            <img src="{{ asset('images/logo.png') }}" alt="EnthusiastVerse Logo" class="footer-logo">
        </div>

        <div class="footer-columns">
            <!-- Navigation Section -->
            <div class="footer-col">
                <h4>Navigation</h4>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="{{ route('about') }}">About us</a></li>
                    <li><a href="{{ route('checkout.track') }}">Track Order</a></li>
                </ul>
            </div>

            <!-- OUR SERVICES Section -->
            <div class="footer-col">
                <h4>OUR SERVICES</h4>
                <ul class="footer-list">
                    <li>Quantity</li>
                    <li>Price (1 per cent)</li>
                    <li>Total energy %</li>
                    <li>QM Costs</li>
                </ul>
            </div>

            <!-- FOLLOW Section -->
            <div class="footer-col">
                <h4>FOLLOW US</h4>
                <ul class="footer-list">
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        
                        <a href="#" class="social-icon" aria-label="TikTok">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z"/>
                            </svg>
                        </a>
                    </div>
                </ul>
            </div>
        </div>

        <div class="footer-copyright">
            <p>© {{ date('Y') }} ENTHUSIASTVERSE. All rights reserved.</p>
        </div>
    </div>
</footer>