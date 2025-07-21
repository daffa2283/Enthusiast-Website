<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProtectWebUserFromAdminLogout
{
    /**
     * Handle an incoming request.
     * 
     * This middleware specifically protects web users from being logged out
     * when admin users logout from Filament dashboard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply this protection on admin routes
        if (!$this->isAdminRoute($request)) {
            return $next($request);
        }
        
        // Store web user state before processing admin request
        $webUser = Auth::guard('web')->user();
        $webUserId = Auth::guard('web')->id();
        $webWasAuthenticated = Auth::guard('web')->check();
        
        // Store critical web session data
        $webSessionData = [];
        if ($webWasAuthenticated) {
            $webSessionData = [
                'cart_count' => $request->session()->get('cart_count', 0),
                'cart_items' => $request->session()->get('cart_items', []),
                'user_preferences' => $request->session()->get('user_preferences', []),
                'flash_messages' => $request->session()->get('_flash', []),
            ];
        }
        
        // Process the admin request
        $response = $next($request);
        
        // CRITICAL: If web user was authenticated but is now gone after admin operation
        if ($webWasAuthenticated && $webUser && !Auth::guard('web')->check()) {
            // IMMEDIATELY re-authenticate web user
            Auth::guard('web')->login($webUser, true);
            
            // Restore all web session data
            foreach ($webSessionData as $key => $value) {
                $request->session()->put($key, $value);
            }
            
            // Log this protection action
            \Log::warning('Web user protected from admin logout', [
                'web_user_id' => $webUserId,
                'admin_request_url' => $request->url(),
                'admin_user_id' => Auth::guard('admin')->id(),
                'timestamp' => now()
            ]);
        }
        
        return $response;
    }
    
    /**
     * Check if this is an admin route
     */
    private function isAdminRoute(Request $request): bool
    {
        return $request->is('admin/*') || 
               str_contains($request->url(), '/admin/') ||
               str_contains($request->url(), 'filament');
    }
}