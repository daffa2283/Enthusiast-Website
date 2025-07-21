<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionIsolation
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Store current authentication states and session data BEFORE processing
        $webUser = Auth::guard('web')->user();
        $adminUser = Auth::guard('admin')->user();
        $webWasLoggedIn = Auth::guard('web')->check();
        $adminWasLoggedIn = Auth::guard('admin')->check();
        
        // Store important session data for web user
        $webSessionData = [];
        if ($webWasLoggedIn) {
            $webSessionData = [
                'cart_count' => $request->session()->get('cart_count', 0),
                'cart_items' => $request->session()->get('cart_items', []),
                'user_preferences' => $request->session()->get('user_preferences', []),
            ];
        }
        
        // Process the request
        $response = $next($request);
        
        // CRITICAL: Ensure session isolation after processing
        
        // If web user was logged in but is now gone, and this wasn't a web logout
        if ($webWasLoggedIn && $webUser && !Auth::guard('web')->check() && !$this->isWebLogout($request)) {
            // FORCE re-authenticate the web user
            Auth::guard('web')->login($webUser, true);
            
            // Restore web session data
            foreach ($webSessionData as $key => $value) {
                $request->session()->put($key, $value);
            }
            
            \Log::info('Web user re-authenticated after admin logout', [
                'user_id' => $webUser->id,
                'request_url' => $request->url()
            ]);
        }
        
        // If admin user was logged in but is now gone, and this wasn't an admin logout
        if ($adminWasLoggedIn && $adminUser && !Auth::guard('admin')->check() && !$this->isAdminLogout($request)) {
            // FORCE re-authenticate the admin user
            Auth::guard('admin')->login($adminUser, true);
            
            \Log::info('Admin user re-authenticated after web logout', [
                'user_id' => $adminUser->id,
                'request_url' => $request->url()
            ]);
        }
        
        return $response;
    }
    
    /**
     * Check if this is a web logout request
     */
    private function isWebLogout(Request $request): bool
    {
        return $request->is('logout') || $request->routeIs('logout');
    }
    
    /**
     * Check if this is an admin logout request
     */
    private function isAdminLogout(Request $request): bool
    {
        return $request->is('admin/logout') || 
               (str_contains($request->url(), 'admin') && str_contains($request->url(), 'logout'));
    }
}