@extends('layouts.app')

@section('title', 'Login - EnthusiastVerse')

@section('content')
<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p>Sign in to your EnthusiastVerse account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="form-input @error('email') error @enderror"
                           placeholder="Enter your email">
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
                               autocomplete="current-password"
                               class="form-input @error('password') error @enderror"
                               placeholder="Enter your password">
                        <button type="button" class="password-toggle" onclick="togglePassword()">
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

                <!-- Remember Me -->
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember_me" class="checkbox-input">
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-text">Remember me</span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <span>Sign In</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10,17 15,12 10,7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </button>
                </div>

                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="register-link">Create one here</a>
                </p>
            </div>
        </div>

        <div class="auth-image">
            <div class="image-overlay">
                <h2>Join the EnthusiastVerse Community</h2>
                <p>Discover unique clothing that expresses your authentic self. Fashion is our medium, authenticity is our message.</p>
                <div class="features">
                    <div class="feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20,6 9,17 4,12"></polyline>
                        </svg>
                        <span>Premium Quality</span>
                    </div>
                    <div class="feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20,6 9,17 4,12"></polyline>
                        </svg>
                        <span>Fast Shipping</span>
                    </div>
                    <div class="feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20,6 9,17 4,12"></polyline>
                        </svg>
                        <span>Authentic Designs</span>
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
    min-height: 600px;
}

.auth-card {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
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

.alert {
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
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
    align-items: center;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.95rem;
    color: #666;
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
    position: relative;
    transition: all 0.3s ease;
    background: #fafafa;
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

.auth-links {
    text-align: center;
    margin-top: 1.5rem;
}

.forgot-password {
    color: #FF3B3F;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: color 0.3s ease;
}

.forgot-password:hover {
    color: #e63946;
    text-decoration: underline;
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

.register-link {
    color: #FF3B3F;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.register-link:hover {
    color: #e63946;
    text-decoration: underline;
}

.auth-image {
    background: linear-gradient(135deg, rgba(255, 59, 63, 0.9), rgba(230, 57, 70, 0.9)), 
                url('{{ asset('images/MOCKUP DEPAN.jpeg.jpg') }}');
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

.features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.feature {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.feature svg {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem;
    border-radius: 50%;
    width: 40px;
    height: 40px;
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
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.eye-icon');
    
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
    const emailInput = document.getElementById('email');
    if (emailInput && !emailInput.value) {
        emailInput.focus();
    }
});
</script>
@endpush