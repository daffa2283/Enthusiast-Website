<?php

namespace App\Filament\Pages\Auth;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Support\Facades\Auth;

class Logout implements LogoutResponse
{
    public function toResponse($request)
    {
        // Logout from admin guard only
        Auth::guard('admin')->logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect to admin login page
        return redirect()->route('filament.admin.auth.login');
    }
}