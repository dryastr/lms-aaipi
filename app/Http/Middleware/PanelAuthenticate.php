<?php

namespace App\Http\Middleware;

use Closure;

class PanelAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (auth()->check() and ! auth()->user()->isAdmin()) {

            $referralSettings = getReferralSettings();
            view()->share('referralSettings', $referralSettings);

            return $next($request);
        }

        return redirect('/login');
    }
}
