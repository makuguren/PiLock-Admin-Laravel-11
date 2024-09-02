<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Request;

class Authenticate implements AuthenticatesRequests
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * The callback that should be used to generate the authentication redirect path.
     *
     * @var callable
     */
    protected static $redirectToCallback;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Specify the guards for the middleware.
     *
     * @param  string  $guard
     * @param  string  $others
     * @return string
     */
    public static function using($guard, ...$others)
    {
        return static::class.':'.implode(',', [$guard, ...$others]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $request->expectsJson() ? null : $this->redirectTo($request),
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request)
    {

        if($request->routeIs('admin.dashboard.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.rfidchecker.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.analytics.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.sections.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.courses.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.students.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.students.create')){
            return route('admin.login');
        }

        if($request->routeIs('admin.students.addtaguid')){
            return route('admin.login');
        }

        if($request->routeIs('admin.instructors.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.instructors.addtaguid')){
            return route('admin.login');
        }

        if($request->routeIs('admin.events.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.schedules.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.schedules.makeup')){
            return route('admin.login');
        }

        if($request->routeIs('admin.schedules.approvals')){
            return route('admin.login');
        }

        if($request->routeIs('admin.admins.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.admins.create')){
            return route('admin.login');
        }

        if($request->routeIs('admin.roles.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.roles.addpermission')){
            return route('admin.login');
        }

        if($request->routeIs('admin.permissions.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.logs.index')){
            return route('admin.login');
        }

        if($request->routeIs('admin.settings.index')){
            return route('admin.login');
        }

        // Instructor Side
        if($request->routeIs('instructor.dashboard.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.attendances.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.attendances.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.attendances.current')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.events.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.courses.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.courses.blocked')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.students.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.schedules.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.schedules.makeup')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.seatplan.index')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.seatplan.assign')){
            return route('instructor.login');
        }

        if($request->routeIs('instructor.settings.index')){
            return route('instructor.login');
        }

        // Student Side
        if($request->routeIs('user.dashboard.index')){
            return route('user.login');
        }

        if($request->routeIs('user.schedules.index')){
            return route('user.login');
        }

        if($request->routeIs('user.courses.index')){
            return route('user.login');
        }

        if($request->routeIs('user.courses.enrolled')){
            return route('user.login');
        }

        if($request->routeIs('user.settings.index')){
            return route('user.login');
        }

        if (static::$redirectToCallback) {
            return call_user_func(static::$redirectToCallback, $request);
        }
    }

    /**
     * Specify the callback that should be used to generate the redirect path.
     *
     * @param  callable  $redirectToCallback
     * @return void
     */
    public static function redirectUsing(callable $redirectToCallback)
    {
        static::$redirectToCallback = $redirectToCallback;
    }
}
