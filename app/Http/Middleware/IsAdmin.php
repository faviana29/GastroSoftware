<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Redirigir a otra ruta si no es admin
        return redirect('/home')->with('error', 'No tienes acceso a esta sección.');
    }
}