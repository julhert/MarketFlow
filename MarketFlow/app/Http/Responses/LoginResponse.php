<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Si es vendedor, va a su panel de administración
        if ($user->hasRole('vendedor')) {
            return redirect()->intended(route('dashboard'));
        } 
        
        // Si es comprador, va a su historial de compras
        elseif ($user->hasRole('comprador')) {
            return redirect()->intended(route('mis-compras'));
        }

        // Fallback por si acaso
        return redirect('/');
    }
}