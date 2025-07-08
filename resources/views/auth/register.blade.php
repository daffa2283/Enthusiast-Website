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

        <div class="auth-image">
            <div class="image-overlay">
                <h2>Start Your Fashion Journey</h2>
                <p>Join thousands of fashion enthusiasts who trust EnthusiastVerse for authentic, high-quality clothing that expresses their unique style.</p>
                <div class="benefits">
                    <div class="benefit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <div>
                            <h4>Exclusive Access</h4>
                            <p>Get early access to new collections and member-only deals</p>
                        </div>
                    </div>
                    <div class="benefit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h2l.4 2m0 0L6 13h11l1.5-8H5.4z"></path>
                            <circle cx="9" cy="20" r="1"></circle>
                            <circle cx="20" cy="20" r="1"></circle>
                        </svg>
                        <div>
                            <h4>Easy Shopping</h4>
                            <p>Save your favorites, track orders, and enjoy faster checkout</p>
                        </div>
                    </div>
                    <div class="benefit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>
                        <div>
                            <h4>Rewards Program</h4>
                            <p>Earn points with every purchase and unlock special rewards</p>
                        </div>
                    </div>
                </div>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 1rem;
    margin-top: -80px;
    padding-top: 120px;
}

.auth-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 1200px;
    width: 100%;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    min-height: 700px;
}

.auth-card {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow-y: auto;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
}

.auth-header p {
    color: #666;
    font-size: 1.1rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-input {
    padding: 1rem;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-input:focus {
    outline: none;
    border-color: #FF3B3F;
    background: white;
    box-shadow: 0 0 0 3px rgba(255, 59, 63, 0.1);
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
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 6px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #FF3B3F;
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

.checkbox-group {
    flex-direction: row;
    align-items: flex-start;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    font-size: 0.95rem;
    color: #666;
    line-height: 1.5;
}

.checkbox-input {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #e5e5e5;
    border-radius: 4px;
    margin-right: 0.75rem;
    margin-top: 2px;
    position: relative;
    transition: all 0.3s ease;
    background: #fafafa;
    flex-shrink: 0;
}

.checkbox-input:checked + .checkbox-custom {
    background: #FF3B3F;
    border-color: #FF3B3F;
}

.checkbox-input:checked + .checkbox-custom::after {
    content: '';
    position: absolute;
    left: 6px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.terms-link {
    color: #FF3B3F;
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    text-decoration: underline;
}

.form-actions {
    margin-top: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e63946, #d62d20);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 59, 63, 0.3);
}

.auth-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e5e5;
}

.auth-footer p {
    color: #666;
    margin: 0;
}

.login-link {
    color: #FF3B3F;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: #e63946;
    text-decoration: underline;
}

.auth-image {
    background: linear-gradient(135deg, rgba(255, 59, 63, 0.9), rgba(230, 57, 70, 0.9)), 
                url('{{ asset('images/MOCKUP DEPAN11.jpeg.jpg') }}');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.image-overlay {
    text-align: center;
    color: white;
    padding: 2rem;
    max-width: 400px;
}

.image-overlay h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.image-overlay p {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.6;
}

.benefits {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    text-align: left;
}

.benefit {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.benefit svg {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem;
    border-radius: 12px;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

.benefit h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
}

.benefit p {
    font-size: 0.9rem;
    margin: 0;
    opacity: 0.8;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .auth-wrapper {
        grid-template-columns: 1fr;
        max-width: 500px;
    }
    
    .auth-image {
        display: none;
    }
    
    .auth-card {
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .auth-container {
        padding: 1rem;
        padding-top: 100px;
    }
    
    .auth-card {
        padding: 1.5rem;
    }
    
    .auth-header h1 {
        font-size: 2rem;
    }
    
    .auth-header p {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .auth-card {
        padding: 1rem;
    }
    
    .auth-header h1 {
        font-size: 1.75rem;
    }
    
    .form-input {
        padding: 0.875rem;
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

// Auto-focus first input
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
});
</script>
@endpush