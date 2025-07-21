<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreserveCsrfToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Store authentication states before processing
        $webUserBefore = Auth::guard('web')->user();
        $adminUserBefore = Auth::guard('admin')->user();
        $originalToken = $request->session()->token();
        
        $response = $next($request);
        
        // Check authentication states after processing
        $webUserAfter = Auth::guard('web')->user();
        $adminUserAfter = Auth::guard('admin')->user();
        
        // If this is a logout request, ensure proper session handling
        if ($this->isLogoutRequest($request)) {
            // If admin logged out but web user should remain logged in
            if ($this->isAdminLogout($request) && $webUserBefore && !$webUserAfter) {
                // Re-authenticate web user
                Auth::guard('web')->login($webUserBefore, true);
            }
            
            // If web user logged out but admin should remain logged in  
            if ($this->isWebLogout($request) && $adminUserBefore && !$adminUserAfter) {
                // Re-authenticate admin user
                Auth::guard('admin')->login($adminUserBefore, true);
            }
            
            // Preserve CSRF token if either guard is still authenticated
            $webLoggedIn = Auth::guard('web')->check();
            $adminLoggedIn = Auth::guard('admin')->check();
            
            if ($webLoggedIn || $adminLoggedIn) {
                $request->session()->put('_token', $originalToken);
            }
        }
        
        return $response;
    }
    
    /**
     * Check if this is a logout request
     */
    private function isLogoutRequest(Request $request): bool
    {
        return $this->isWebLogout($request) || $this->isAdminLogout($request);
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
               str_contains($request->url(), 'admin') && str_contains($request->url(), 'logout');
    }
}