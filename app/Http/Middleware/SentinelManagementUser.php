<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelManagementUser
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
        $admin = Sentinel::findRoleByName('Management');

        if (!$user->inRole($admin)) {
            return redirect('login');
        }
        return $next($request);
    }
}