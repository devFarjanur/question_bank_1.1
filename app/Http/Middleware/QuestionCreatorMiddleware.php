<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('questioncreator')->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
