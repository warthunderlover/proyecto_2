<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        ],
        'api' => [
        ],
    ];
    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}