<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user) {
            $check = \DB::table('auto_logouts')->where('user_id', $user->id)->exists();
            if ($check) {
                \DB::table('auto_logouts')->where('user_id', $user->id)->delete();
                Auth::logout();

                return redirect('/');
            }
        }

        return $next($request);
    }
}
