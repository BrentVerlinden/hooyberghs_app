<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if (auth()->user()->admin == true) {
//            return $next($request);
//        }
//        return abort(403, 'Enkel admins toegelaten');
        if (auth()->check() && auth()->user()->admin) {
            return $next($request);
        }
        return abort(403, 'Enkel admins toegelaten');
    }
}
