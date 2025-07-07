@extends('layouts.app')

@section('title', 'Profile - EnthusiastVerse')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="container">
            <h1>Profile Settings</h1>
            <p>Manage your account information and preferences</p>
        </div>
    </div>

    <div class="profile-content">
        <div class="container">
            <div class="profile-grid">
                <div class="profile-section">
                    <h2>Profile Information</h2>
                    <div class="profile-card">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="profile-section">
                    <h2>Update Password</h2>
                    <div class="profile-card">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="profile-section">
                    <h2>Delete Account</h2>
                    <div class="profile-card">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.profile-container {
    margin-top: 80px;
    min-height: calc(100vh - 80px);
    background: #f8f9fa;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.profile-header {
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    color: white;
    padding: 3rem 0;
    text-align: center;
}

.profile-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.profile-header p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.profile-content {
    padding: 3rem 0;
}

.profile-grid {
    display: grid;
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.profile-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.profile-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* Form Styles */
.profile-card form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.profile-card label {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    display: block;
}

.profile-card input[type="text"],
.profile-card input[type="email"],
.profile-card input[type="password"] {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.profile-card input:focus {
    outline: none;
    border-color: #FF3B3F;
}

.profile-card button {
    background: linear-gradient(135deg, #FF3B3F, #e63946);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-card button:hover {
    background: linear-gradient(135deg, #e63946, #d62d20);
    transform: translateY(-1px);
}

.profile-card .text-red-600 {
    color: #dc2626;
}

.profile-card .text-green-600 {
    color: #059669;
}

.profile-card .text-sm {
    font-size: 0.875rem;
}

.profile-card .mt-2 {
    margin-top: 0.5rem;
}

.profile-card .flex {
    display: flex;
    gap: 1rem;
    align-items: center;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 0 1rem;
    }
    
    .profile-header h1 {
        font-size: 2rem;
    }
    
    .profile-card {
        padding: 1.5rem;
    }
}
</style>
@endpush