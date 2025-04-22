<?php

namespace App\Http;

class Kernel
{
    protected $middlewareAliases = [
        // ...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}