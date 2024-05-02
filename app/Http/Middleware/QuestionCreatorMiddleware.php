<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class QuestionCreatorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('questioncreator')->check()) {
            return redirect('/question-creator/login');
        }

        return $next($request);
    }
}