<?php

namespace App\Http\Middleware;

use Closure;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->getPathInfo();
        $ignoreRoutes = [
            '/maintenance',
            '/locale',
        ];

        if (! in_array($route, $ignoreRoutes) and ! request()->is('laravel-filemanager*')) {
            if (! empty(getFeaturesSettings('maintenance_status')) and getFeaturesSettings('maintenance_status')) {
                $maintenanceAccessKey = getFeaturesSettings('maintenance_access_key');

                if (! empty($maintenanceAccessKey) and ! empty($request->get($maintenanceAccessKey))) {
                    return $next($request);
                }

                return redirect(route('maintenanceRoute'));
            }
        }

        return $next($request);
    }
}
