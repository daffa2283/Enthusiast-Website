<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        // First, check if user exists and has admin role
        $user = \App\Models\User::where('email', $data['email'])->first();
        
        if (!$user || !$user->isAdmin()) {
            throw ValidationException::withMessages([
                'data.email' => 'Access denied. Admin privileges required.',
            ]);
        }

        // Attempt to authenticate with admin guard
        if (!Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => 'These credentials do not match our records.',
            ]);
        }

        session()->regenerate();
        
        return app(LoginResponse::class);
    }
}