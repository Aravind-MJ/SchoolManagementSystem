<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        //'auth' => \App\Http\Middleware\Authenticate::class,
        'auth' => \App\Http\Middleware\SentinelAuthenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        //'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'guest' => \App\Http\Middleware\SentinelRedirectIfAuthenticated::class,
        'studentUser' => \App\Http\Middleware\SentinelStudentUser::class,
        'admin' => \App\Http\Middleware\SentinelAdminUser::class,
        'management' => \App\Http\Middleware\SentinelManagementUser::class,
        'administrator' => \App\Http\Middleware\SentinelAdministrator::class,
        'faculty' => \App\Http\Middleware\SentinelFacultyUser::class,
        'notCurrentUser' => \App\Http\Middleware\SentinelNotCurrentUser::class,
        'redirectAdmin' => \App\Http\Middleware\SentinelRedirectAdmin::class,
        'redirectStudentUser' => \App\Http\Middleware\SentinelRedirectStudentUser::class,
        'redirectManagement' => \App\Http\Middleware\SentinelRedirectManagement::class,
        'redirectAdministrator' => \App\Http\Middleware\SentinelRedirectAdministrator::class,
        'redirectFaculty' => \App\Http\Middleware\SentinelRedirectFaculty::class,
    ];
}
