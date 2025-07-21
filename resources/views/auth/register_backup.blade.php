@extends('layouts.app')

@section('title', 'Register - EnthusiastVerse')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Join EnthusiastVerse</h1>
                <p>Create your account and start your fashion journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           class="form-input @error('name') error @enderror"
                           placeholder="Enter your full name">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           class="form-input @error('email') error @enderror"
                           placeholder="Enter your email address">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               class="form-input @error('password') error @enderror"
                               placeholder="Create a strong password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               class="form-input @error('password_confirmation') error @enderror"
                               placeholder="Confirm your password">
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="terms" id="terms" class="checkbox-input" required>
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-text">
                            I agree to the <a href="#" class="terms-link">Terms of Service</a> and 
                            <a href="#" class="terms-link">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <span>Create Account</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="auth-footer">
                <p>Already have an account? 
                    <a href="{{ route('login') }}" class="login-link">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    padding: 2rem 1rem;
    margin-top: -80px;
    padding-top: 120px;
}

.auth-wrapper {
    max-width: 450px;
    width: 100%;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
}

.auth-card {
    padding: 2.5rem;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.auth-header p {
    color: #6c757d;
    font-size: 0.95rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-input {
    padding: 0.875rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: white;
}

.form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-input.error {
    border-color: #ef4444;
    background: #fef2f2;
}

.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 0.875rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6b7280;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: color 0.2s ease;
}

.password-toggle:hover {
    color: #374151;
}

.error-message {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.checkbox-group {
    flex-direction: row;
    align-items: flex-start;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.5;
}

.checkbox-input {
    display: none;
}

.checkbox-custom {
    width: 18px;
    height: 18px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    margin-right: 0.75rem;
    margin-top: 2px;
    position: relative;
    transition: all 0.2s ease;
    background: white;
    flex-shrink: 0;
}

.checkbox-input:checked + .checkbox-custom {
    background: #3b82f6;
    border-color: #3b82f6;
}

.checkbox-input:checked + .checkbox-custom::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 1px;
    width: 5px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.terms-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    color: #2563eb;
    text-decoration: underline;
}

.form-actions {
    margin-top: 0.5rem;
}

.btn-primary {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.auth-footer p {
    color: #6b7280;
    margin: 0;
    font-size: 0.9rem;
}

.login-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.login-link:hover {
    color: #2563eb;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .auth-container {
        padding: 1rem;
        padding-top: 100px;
    }
    
    .auth-card {
        padding: 2rem;
    }
    
    .auth-header h1 {
        font-size: 1.6rem;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 1.5rem;
    }
    
    .auth-header h1 {
        font-size: 1.5rem;
    }
    
    .form-input {
        padding: 0.75rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = passwordInput.parentElement.querySelector('.eye-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        `;
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        `;
    }
}

// Auto-hide navbar functionality for auth pages
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    if (nameInput && !nameInput.value) {
        nameInput.focus();
    }
    
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    
    // Real-time password confirmation validation
    confirmPasswordInput.addEventListener('input', function() {
        if (passwordInput.value && confirmPasswordInput.value) {
            if (passwordInput.value === confirmPasswordInput.value) {
                confirmPasswordInput.classList.remove('error');
            } else {
                confirmPasswordInput.classList.add('error');
            }
        }
    });
    
    // Auto-hide navbar functionality
    const header = document.querySelector('.header');
    let hoverTrigger;
    let hideTimeout;
    let isNavbarVisible = false;
    
    // Create hover trigger area
    function createHoverTrigger() {
        hoverTrigger = document.createElement('div');
        hoverTrigger.className = 'auth-hover-trigger active';
        document.body.appendChild(hoverTrigger);
    }
    
    // Hide navbar initially
    function hideNavbar() {
        if (header) {
            header.classList.add('auth-hidden');
            header.classList.remove('auth-visible');
            isNavbarVisible = false;
        }
    }
    
    // Show navbar
    function showNavbar() {
        if (header) {
            header.classList.remove('auth-hidden');
            header.classList.add('auth-visible');
            isNavbarVisible = true;
            
            // Clear any existing hide timeout
            if (hideTimeout) {
                clearTimeout(hideTimeout);
            }
        }
    }
    
    // Auto-hide navbar after delay
    function autoHideNavbar() {
        hideTimeout = setTimeout(() => {
            hideNavbar();
        }, 3000); // Hide after 3 seconds
    }
    
    // Initialize auto-hide functionality
    function initAutoHide() {
        createHoverTrigger();
        
        // Hide navbar initially after a short delay
        setTimeout(hideNavbar, 1000);
        
        // Mouse enter trigger area - show navbar
        hoverTrigger.addEventListener('mouseenter', function() {
            showNavbar();
        });
        
        // Mouse leave header - start auto-hide timer
        header.addEventListener('mouseleave', function(e) {
            // Check if mouse is moving to trigger area
            const rect = hoverTrigger.getBoundingClientRect();
            if (e.clientY > rect.bottom) {
                autoHideNavbar();
            }
        });
        
        // Mouse enter header - cancel auto-hide
        header.addEventListener('mouseenter', function() {
            if (hideTimeout) {
                clearTimeout(hideTimeout);
            }
        });
        
        // Touch events for mobile
        let touchStartY = 0;
        
        document.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
        });
        
        document.addEventListener('touchmove', function(e) {
            const touchY = e.touches[0].clientY;
            const deltaY = touchY - touchStartY;
            
            // If swiping down from top of screen, show navbar
            if (touchStartY < 50 && deltaY > 30 && !isNavbarVisible) {
                showNavbar();
                autoHideNavbar();
            }
        });
        
        // Hide navbar when clicking outside
        document.addEventListener('click', function(e) {
            if (isNavbarVisible && !header.contains(e.target) && !hoverTrigger.contains(e.target)) {
                autoHideNavbar();
            }
        });
    }
    
    // Initialize the auto-hide functionality
    initAutoHide();
});
</script>
@endpush