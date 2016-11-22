<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelRedirectAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            $admin = Sentinel::findRoleByName('Administrator');

            if ($user->inRole($admin)) {
                return redirect()->intended('administrator');
            }
        }
        return $next($request);
    }
}
