<?php

namespace App\Filament\Pages\Auth;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Support\Facades\Auth;

class Logout implements LogoutResponse
{
    public function toResponse($request)
    {
        // CRITICAL: Store web user state BEFORE any logout operations
        $webUser = Auth::guard('web')->user();
        $webUserId = Auth::guard('web')->id();
        $webWasLoggedIn = Auth::guard('web')->check();
        
        // Store session data that might be needed for web user
        $webSessionData = [];
        if ($webWasLoggedIn) {
            $webSessionData = [
                'user_id' => $webUserId,
                'remember_token' => $webUser->remember_token ?? null,
                'cart_count' => $request->session()->get('cart_count', 0),
                'cart_items' => $request->session()->get('cart_items', []),
            ];
        }
        
        // Logout ONLY from admin guard - should not affect web guard
        Auth::guard('admin')->logout();
        
        // IMMEDIATELY restore web user if they were logged in
        if ($webWasLoggedIn && $webUser) {
            // Force re-login web user with remember token
            Auth::guard('web')->login($webUser, true);
            
            // Restore web session data
            foreach ($webSessionData as $key => $value) {
                if ($key !== 'user_id' && $key !== 'remember_token') {
                    $request->session()->put($key, $value);
                }
            }
        }
        
        // NEVER regenerate CSRF token if web user is active
        // This is critical to prevent "page expired" errors
        if (!Auth::guard('web')->check()) {
            $request->session()->regenerateToken();
        }
        
        // Redirect to admin login page
        return redirect()->route('filament.admin.auth.login')
            ->with('status', 'Admin logged out successfully');
    }
}