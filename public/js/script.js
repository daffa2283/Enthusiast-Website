document.addEventListener('DOMContentLoaded', () => {
    // Toggle mobile menu
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    // Cart functionality
    let cartCount = 0;
    const cartButtons = document.querySelectorAll('.add-to-cart');
    const cartCounter = document.querySelector('.cart-counter');
    
    cartButtons.forEach(button => {
        button.addEventListener('click', () => {
            cartCount++;
            cartCounter.textContent = cartCount;
        });
    });
});

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.toggle('active');
    });
    
    // Cart functionality
    let cartCount = 0;
    const cartCounter = document.querySelector('.cart-counter');
    
    // Example: Add to cart functionality
    // You can hook this up to actual add-to-cart buttons
    function addToCart() {
        cartCount++;
        cartCounter.textContent = cartCount;
    }
});