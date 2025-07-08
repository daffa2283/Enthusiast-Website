# Admin Authentication Separation

## Overview
This document explains the implementation of separate authentication for the Filament admin panel and the main web application.

## Problem
Previously, when an admin logged into the Filament admin panel, they were automatically logged into the main web application as well, and vice versa. This was because both systems used the same authentication guard (`web`).

## Solution
We've implemented separate authentication guards to isolate admin and user sessions:

### 1. Authentication Guards Configuration
**File: `config/auth.php`**

Added a new `admin` guard:
```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],
```

Added a new `admins` provider:
```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],
```

### 2. Filament Admin Panel Configuration
**File: `app/Providers/Filament/AdminPanelProvider.php`**

- Set the admin panel to use the `admin` guard: `->authGuard('admin')`
- Created custom login page: `->login(Login::class)`
- Replaced authentication middleware with custom `FilamentAdminAuth`

### 3. Custom Authentication Middleware
**File: `app/Http/Middleware/FilamentAdminAuth.php`**

This middleware:
- Uses the `admin` guard for authentication checks
- Verifies that the user has admin privileges
- Redirects to the Filament admin login page if authentication fails

### 4. Custom Login Page
**File: `app/Filament/Pages/Auth/Login.php`**

This custom login page:
- Validates that the user has admin role before authentication
- Uses the `admin` guard for login attempts
- Provides appropriate error messages for non-admin users

### 5. Custom Logout Response
**File: `app/Filament/Pages/Auth/Logout.php`**

This ensures that logout only affects the admin session:
- Logs out from the `admin` guard only
- Redirects to the admin login page

## Benefits

1. **Session Isolation**: Admin and regular user sessions are completely separate
2. **Security**: Admin access is restricted to users with admin role
3. **User Experience**: Regular users won't be affected by admin login/logout actions
4. **Flexibility**: Each system can have different authentication rules and behaviors

## Usage

### For Admins:
- Access admin panel at `/admin`
- Login with admin credentials
- Logging out from admin panel won't affect main website session

### For Regular Users:
- Access main website normally
- Login/logout actions won't affect admin panel session
- Cannot access admin panel even if logged into main website

## Technical Details

### Guard Usage:
- **Web Application**: Uses `web` guard (default)
- **Admin Panel**: Uses `admin` guard

### Session Management:
- Each guard maintains its own session
- Sessions are isolated and don't interfere with each other

### Middleware Chain:
- **Web routes**: Standard Laravel authentication middleware
- **Admin routes**: Custom `FilamentAdminAuth` middleware

## Testing

To test the separation:

1. Login to the main website as a regular user
2. Try to access `/admin` - should be redirected to admin login
3. Login to admin panel with admin credentials
4. Check that main website session is unaffected
5. Logout from admin panel
6. Verify that main website session remains active

## Maintenance

When adding new admin features:
- Use `Auth::guard('admin')` for admin-specific authentication checks
- Ensure middleware uses the correct guard
- Test session isolation after changes