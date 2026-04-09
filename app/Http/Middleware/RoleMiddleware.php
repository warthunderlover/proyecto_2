<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $rol)
    {
        if(auth()->check() && auth()->user()->rol == $rol){
            return $next($request);
        } 

        return redirect('/')->with('error','No tienes permiso para acceder a esa página.');
    }
}
