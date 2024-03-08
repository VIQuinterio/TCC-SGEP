<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            // Se for um administrador, define a guarda 'admin'
            Auth::shouldUse('admin');
        } else {
            // Se não, define a guarda padrão (mas nas rotas o no fica como app)
            Auth::shouldUse('web');
        }

        return $next($request);
    }
}
