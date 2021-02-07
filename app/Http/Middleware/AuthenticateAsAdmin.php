<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthenticateAsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_if(
            $request->user()->role !== User::ADMIN_ROLE,
            403,
            "Vous n'êtes pas autorisé à accéder à cette partie du site."
        );

        return $next($request);
    }
}
