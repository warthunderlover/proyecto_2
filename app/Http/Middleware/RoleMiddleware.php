<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }*/
    public function handle($request, Closure $next, $rol)
    {
        if(auth()->check() && auth()->user()->rol == $rol){
            return $next($request);
        } //revisa si el usuario esta logueado y obtiene el rol correspondiente lo valida.

        return redirect('/')->with('error','No tienes permiso para acceder a esa página.');
    }
}
