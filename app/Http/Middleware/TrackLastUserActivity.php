<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackLastUserActivity
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
        if (!$request->user()) {
            return $next($request);
        }
        
        if (!$request->user()->last_activity_at || $request->user()->last_activity_at < now()->subMinutes(5)) {
            $request->user()->update([
                'last_activity_at' => now(),
            ]);
        }

        return $next($request);
    }
}
