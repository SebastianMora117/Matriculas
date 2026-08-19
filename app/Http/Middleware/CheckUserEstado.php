<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserEstado
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->estado == 0) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['email' => 'Usuario inactivo. Contacta al administrador.']);
        }

        return $next($request);
    }
}