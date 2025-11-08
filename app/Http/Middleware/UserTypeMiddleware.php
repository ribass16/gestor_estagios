<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTypeMiddleware
{
    public function handle(Request $request, Closure $next, $type)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->user_type !== $type) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
