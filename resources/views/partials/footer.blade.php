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
                        <a href="https://www.instagram.com/enthusiastverse/" class="social-icon" aria-label="Instagram" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512">
                                <defs>
                                    <linearGradient id="instagram-gradient" x1="0%" y1="70%" x2="100%" y2="30%">
                                        <stop offset="0%" stop-color="#f9ce34" />
                                        <stop offset="50%" stop-color="#ee2a7b" />
                                        <stop offset="100%" stop-color="#6228d7" />
                                    </linearGradient>
                                </defs>
                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" fill="url(#instagram-gradient)"/>
                            </svg>
                        </a>
                        
                        <a href="https://www.tiktok.com/@enthusiastverse" class="social-icon" aria-label="TikTok" target="_blank">
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