<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserTypeMiddleware
{
    public function handle($request, Closure $next, ...$types)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!in_array(Auth::user()->user_type, $types)) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
