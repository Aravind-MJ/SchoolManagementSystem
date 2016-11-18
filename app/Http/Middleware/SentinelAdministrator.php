<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelAdministrator
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
        $user = Sentinel::getUser();
        $admin = Sentinel::findRoleByName('Administrator');

        if (!$user->inRole($admin)) {
            return redirect('login');
        }
        return $next($request);
    }
}
