document.addEventListener('DOMContentLoaded', function() {
    // Header scroll effect
    const header = document.querySelector('.header');
    let lastScrollY = window.scrollY;
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Hide/show header on scroll
        if (window.scrollY > lastScrollY && window.scrollY > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        lastScrollY = window.scrollY;
    });

    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // User menu dropdown functionality
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdown = document.getElementById('userDropdown');
    const userMenu = document.querySelector('.user-menu');
    
    if (userMenuToggle && userDropdown) {
        userMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenu.contains(e.target)) {
                userMenu.classList.remove('active');
            }
        });
    }

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchSuggestions = document.getElementById('searchSuggestions');
    
    if (searchInput && searchSuggestions) {
        let searchTimeout;
        let currentRequest = null;
        
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            // Cancel previous request
            if (currentRequest) {
                currentRequest.abort();
            }
            
            if (query.length >= 2) {
                searchTimeout = setTimeout(() => {
                    fetchSearchSuggestions(query);
                }, 300);
            } else {
                hideSearchSuggestions();
            }
        });
        
        searchInput.addEventListener('focus', function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                fetchSearchSuggestions(query);
            }
        });
        
        searchInput.addEventListener('blur', function() {
            // Delay hiding to allow clicking on suggestions
            setTimeout(() => {
                hideSearchSuggestions();
            }, 200);
        });
        
        // Handle keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const suggestions = searchSuggestions.querySelectorAll('.suggestion-item');
            const activeSuggestion = searchSuggestions.querySelector('.suggestion-item.active');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (activeSuggestion) {
                    activeSuggestion.classList.remove('active');
                    const next = activeSuggestion.nextElementSibling;
                    if (next) {
                        next.classList.add('active');
                    } else {
                        suggestions[0]?.classList.add('active');
                    }
                } else {
                    suggestions[0]?.classList.add('active');
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (activeSuggestion) {
                    activeSuggestion.classList.remove('active');
                    const prev = activeSuggestion.previousElementSibling;
                    if (prev) {
                        prev.classList.add('active');
                    } else {
                        suggestions[suggestions.length - 1]?.classList.add('active');
                    }
                } else {
                    suggestions[suggestions.length - 1]?.classList.add('active');
                }
            } else if (e.key === 'Enter') {
                if (activeSuggestion) {
                    e.preventDefault();
                    activeSuggestion.click();
                }
            } else if (e.key === 'Escape') {
                hideSearchSuggestions();
            }
        });
    }
    
    function fetchSearchSuggestions(query) {
        if (!searchSuggestions) return;
        
        // Show loading state
        searchSuggestions.innerHTML = '<div class="search-loading">Searching...</div>';
        searchSuggestions.classList.add('show');
        
        // Create new request
        currentRequest = new AbortController();
        
        fetch(`/search/suggestions?q=${encodeURIComponent(query)}`, {
            signal: currentRequest.signal
        })
        .then(response => response.json())
        .then(products => {
            if (products.length > 0) {
                const suggestionsHTML = products.map(product => `
                    <a href="${product.url}" class="suggestion-item" data-product-id="${product.id}">
                        <img src="${product.image}" alt="${product.name}" class="suggestion-image" loading="lazy">
                        <div class="suggestion-content">
                            <div class="suggestion-name">${product.name}</div>
                        </div>
                    </a>
                `).join('');
                
                searchSuggestions.innerHTML = suggestionsHTML;
                searchSuggestions.classList.add('show');
                
                // Add click handlers
                searchSuggestions.querySelectorAll('.suggestion-item').forEach(item => {
                    item.addEventListener('mouseenter', function() {
                        // Remove active class from all items
                        searchSuggestions.querySelectorAll('.suggestion-item').forEach(i => i.classList.remove('active'));
                        // Add active class to hovered item
                        this.classList.add('active');
                    });
                    
                    item.addEventListener('click', function(e) {
                        // Let the link work normally
                        hideSearchSuggestions();
                    });
                });
            } else {
                searchSuggestions.innerHTML = '<div class="no-suggestions">No products found</div>';
                searchSuggestions.classList.add('show');
            }
        })
        .catch(error => {
            if (error.name !== 'AbortError') {
                console.error('Search error:', error);
                searchSuggestions.innerHTML = '<div class="no-suggestions">Search temporarily unavailable</div>';
                searchSuggestions.classList.add('show');
            }
        });
    }
    
    function hideSearchSuggestions() {
        if (searchSuggestions) {
            searchSuggestions.classList.remove('show');
            setTimeout(() => {
                if (!searchSuggestions.classList.contains('show')) {
                    searchSuggestions.innerHTML = '';
                }
            }, 300);
        }
    }
    
    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (searchInput && searchSuggestions && !searchInput.closest('.search-container').contains(e.target)) {
            hideSearchSuggestions();
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.querySelectorAll('.product-card, .section-title, .about').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Loading states for buttons
    function addLoadingState(button) {
        button.classList.add('loading');
        button.disabled = true;
    }
    
    function removeLoadingState(button) {
        button.classList.remove('loading');
        button.disabled = false;
    }

    // Enhanced cart functionality
    const cartIcon = document.querySelector('.cart-icon');
    
    if (cartIcon) {
        cartIcon.addEventListener('click', function(e) {
            // Add a subtle animation when clicking cart
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // Keyboard navigation support
    document.addEventListener('keydown', function(e) {
        // ESC key to close modals/dropdowns
        if (e.key === 'Escape') {
            // Close user dropdown
            if (userMenu && userMenu.classList.contains('active')) {
                userMenu.classList.remove('active');
            }
            
            // Close mobile menu
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                mobileMenuToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
            
            // Hide search suggestions
            hideSearchSuggestions();
        }
    });

    // Performance optimization: Debounce scroll events
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Lazy loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // Add CSS for lazy loading
    const style = document.createElement('style');
    style.textContent = `
        .lazy {
            opacity: 0;
            transition: opacity 0.3s;
        }
        .lazy.loaded {
            opacity: 1;
        }
        
        .suggestion-item {
            padding: 0.75rem 1rem;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
        }
        
        .suggestion-item:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
        }
        
        .suggestion-item:last-child {
            border-bottom: none;
        }
    `;
    document.head.appendChild(style);

    // Enhanced logout functionality with multiple fallback approaches
    const logoutForms = document.querySelectorAll('#logoutForm, #mobileLogoutForm');
    
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Method 1: Try with fresh CSRF token
            fetch('/csrf-token', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update CSRF token in form
                const csrfInput = form.querySelector('input[name="_token"]');
                if (csrfInput && data.csrf_token) {
                    csrfInput.value = data.csrf_token;
                }
                
                // Update meta tag
                const metaTag = document.querySelector('meta[name="csrf-token"]');
                if (metaTag && data.csrf_token) {
                    metaTag.setAttribute('content', data.csrf_token);
                }
                
                // Submit form
                submitLogoutForm(form);
            })
            .catch(error => {
                console.log('CSRF refresh failed, trying alternative logout methods:', error);
                // Method 2: Try direct AJAX logout
                performAjaxLogout();
            });
        });
    });
    
    function submitLogoutForm(form) {
        // Create a temporary form to avoid any event listeners
        const tempForm = document.createElement('form');
        tempForm.method = 'POST';
        tempForm.action = form.action;
        tempForm.style.display = 'none';
        
        // Copy CSRF token
        const csrfInput = form.querySelector('input[name="_token"]');
        if (csrfInput) {
            const newCsrfInput = document.createElement('input');
            newCsrfInput.type = 'hidden';
            newCsrfInput.name = '_token';
            newCsrfInput.value = csrfInput.value;
            tempForm.appendChild(newCsrfInput);
        }
        
        document.body.appendChild(tempForm);
        tempForm.submit();
    }
    
    function performAjaxLogout() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (response.ok || response.redirected) {
                // Logout successful, redirect to home
                window.location.href = '/';
            } else {
                // If AJAX fails, try simple redirect
                window.location.href = '/logout';
            }
        })
        .catch(error => {
            console.log('AJAX logout failed, redirecting manually:', error);
            // Last resort: simple redirect
            window.location.href = '/';
        });
    }

    console.log('EnthusiastVerse website loaded successfully! 🚀');
});