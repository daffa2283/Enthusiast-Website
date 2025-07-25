# Session Separation Solution

## Problem
When users logout from the main website, the admin panel (Filament) experiences "page expired" errors and vice versa. This happens because both systems share the same session and CSRF token, and logout operations regenerate the CSRF token causing the other system to become invalid.

## Root Cause
The issue was caused by:
1. **Shared CSRF Token**: Both web and admin systems use the same CSRF token
2. **Token Regeneration**: When one system logs out, `$request->session()->regenerateToken()` invalidates the token for both systems
3. **Session Invalidation**: Some logout handlers were calling `$request->session()->invalidate()` which destroys the entire session

## Solution Implemented

### 1. Removed Problematic Middleware

Removed `AuthenticateSession::class` middleware from Filament AdminPanelProvider as it was causing cross-logout issues between web and admin systems.

### 2. Modified Logout Controllers

#### Web Logout (`AuthenticatedSessionController.php`)
```php
public function destroy(Request $request): RedirectResponse
{
    // Only logout from web guard, don't invalidate entire session
    Auth::guard('web')->logout();

    // Only regenerate token if admin is not logged in
    // This prevents "page expired" errors in admin panel
    if (!Auth::guard('admin')->check()) {
        $request->session()->regenerateToken();
    }

    return redirect('/')->with('success', 'You have been logged out successfully.');
}
```

#### Admin Logout (`app/Filament/Pages/Auth/Logout.php`)
```php
public function toResponse($request)
{
    // Logout from admin guard only
    Auth::guard('admin')->logout();
    
    // Only regenerate token if web user is not logged in
    // This prevents "page expired" errors in web interface
    if (!Auth::guard('web')->check()) {
        $request->session()->regenerateToken();
    }
    
    // Redirect to admin login page
    return redirect()->route('filament.admin.auth.login');
}
```

### 3. Session Isolation Middleware

Created two middleware for better session handling:

#### `PreserveCsrfToken` Middleware
- Stores the original CSRF token before logout processing
- Restores the token if either guard is still authenticated
- Prevents token invalidation when both systems are active
- Re-authenticates users if they were accidentally logged out

#### `EnsureSessionIsolation` Middleware
- Monitors authentication states before and after requests
- Automatically re-authenticates users if they were unintentionally logged out
- Ensures web and admin sessions remain completely isolated
- Prevents cross-contamination between logout operations

#### `ProtectWebUserFromAdminLogout` Middleware
- **CRITICAL**: Specifically protects web users from admin logout operations
- Stores web user state and session data before admin operations
- Immediately re-authenticates web user if they get logged out during admin operations
- Restores cart data, preferences, and other web session data
- Logs protection actions for monitoring

### 3. Auto CSRF Token Refresh

Added JavaScript to the main layout that:
- Refreshes CSRF token every 30 seconds
- Updates token when user switches back to the tab
- Handles CSRF mismatch errors globally
- Updates all CSRF input fields automatically

### 4. Enhanced Logout JavaScript

Improved the logout handling in `script.js` with:
- Fresh CSRF token fetching before logout
- Multiple fallback mechanisms
- AJAX logout as backup
- Graceful error handling

## How It Works

### Normal Operation
1. **Web User Logout**: Only logs out web guard, preserves admin session if active
2. **Admin User Logout**: Only logs out admin guard, preserves web session if active
3. **CSRF Token**: Only regenerated if the other system is not active

### Token Management
1. **Automatic Refresh**: CSRF tokens are refreshed every 30 seconds
2. **Smart Regeneration**: Tokens are only regenerated when safe to do so
3. **Cross-System Preservation**: Active sessions prevent token invalidation

### Error Prevention
1. **Middleware Protection**: `PreserveCsrfToken` middleware prevents token conflicts
2. **JavaScript Fallbacks**: Multiple logout methods ensure success
3. **Auto-Recovery**: Automatic token refresh handles temporary mismatches

## Benefits

✅ **Eliminates "page expired" errors** between web and admin systems
✅ **Maintains separate authentication** for web and admin users  
✅ **Preserves user sessions** when the other system logs out
✅ **Automatic token management** prevents manual intervention
✅ **Graceful error handling** with multiple fallback mechanisms
✅ **Real-time token refresh** keeps both systems synchronized

## Testing Scenarios

1. **Web user logs out** → Admin panel remains functional
2. **Admin user logs out** → Web interface remains functional  
3. **Both systems active** → CSRF tokens remain valid for both
4. **Token expiration** → Automatic refresh prevents errors
5. **Network issues** → Fallback mechanisms ensure logout success

## Files Modified

1. `app/Http/Controllers/Auth/AuthenticatedSessionController.php` - Web logout logic
2. `app/Filament/Pages/Auth/Logout.php` - **ENHANCED** Admin logout with robust web user protection
3. `app/Http/Middleware/PreserveCsrfToken.php` - New middleware for token preservation
4. `app/Http/Middleware/EnsureSessionIsolation.php` - Enhanced middleware for session isolation
5. `app/Http/Middleware/ProtectWebUserFromAdminLogout.php` - **NEW** Critical protection middleware
6. `app/Http/Kernel.php` - Registered new middleware
7. `app/Providers/Filament/AdminPanelProvider.php` - Removed AuthenticateSession, added protection middleware
8. `resources/views/layouts/app.blade.php` - Auto CSRF refresh script
9. `public/js/script.js` - Enhanced logout handling
10. `routes/web.php` - CSRF token refresh endpoint + session isolation test endpoint

## Testing

Use `/test-session-isolation` endpoint to monitor session states:
- Shows current web and admin user authentication status
- Displays session ID and CSRF token
- Useful for debugging session isolation issues

This solution ensures both web and admin systems can operate independently without interfering with each other's sessions or CSRF tokens.