<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    /**
     * Get the response for unauthenticated users.
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new UnauthorizedHttpException('Bearer', 'Acceso no autorizado. Token de acceso no válido.');
    }
}
