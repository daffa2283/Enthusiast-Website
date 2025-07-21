<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Check if user is admin and redirect accordingly
        if (Auth::user()->isAdmin()) {
            return redirect()->intended('/admin-panel');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
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
}