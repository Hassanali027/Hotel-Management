<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        if (! empty($roles) && ! in_array(auth()->user()->role, $roles)) {
            abort(403, 'Access denied — your role does not permit this section.');
        }
        return $next($request);
    }
}
