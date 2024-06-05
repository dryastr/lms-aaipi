<?php

namespace App\Http\Middleware\Api;

//use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::guard('api')->check()) {
            return apiResponse2(0, 'authorized', 'user has been authenticated');

        }

        return $next($request);

    }
}
