<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // middleware global
    ];

    protected $middlewareGroups = [
        'web' => [
            // middleware web
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        ],
        'api' => [
            // middleware api
        ],
    ];

    protected $routeMiddleware = [
        // middleware por ruta
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}