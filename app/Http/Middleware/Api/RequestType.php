<?php

namespace App\Http\Middleware\Api;

use Closure;

class RequestType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Content-Type') !== 'application/json' || ! $request->hasHeader('Content-Type')) {
            return apiResponse2(1, 'invalid_content_type', 'wrong Content-Type; the Content-Type of header must be \'application/json\'');
        }

        return $next($request);
    }
}
