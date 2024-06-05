<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AdminLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // locale config
        if (! Session::has('locale')) {
            Session::put('locale', mb_strtolower(getDefaultLocale()));
        }
        App::setLocale(session('locale'));

        $generalSettings = getGeneralSettings();
        view()->share('generalSettings', $generalSettings);

        return $next($request);
    }
}
