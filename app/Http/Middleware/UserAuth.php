<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;

class UserAuth extends Middleware
{

    public function handle($request, Closure $next)
    {
        if (!empty(session('authenticated'))) {
            $request->session()->put('authenticated', time());
            return $next($request);
        }

        return redirect(route('login'));
    }
}
