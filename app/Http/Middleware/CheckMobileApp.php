<?php

namespace App\Http\Middleware;

use Closure;

class CheckMobileApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getPathInfo() != route('mobileAppRoute') and ! request()->is('laravel-filemanager*')) {
            if (! empty(getFeaturesSettings('mobile_app_status')) and getFeaturesSettings('mobile_app_status')) {
                return redirect(route('mobileAppRoute'));
            }
        }

        return $next($request);
    }
}
