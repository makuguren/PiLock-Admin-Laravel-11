<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * The callback that should be used to generate the authentication redirect path.
     *
     * @var callable|null
     */
    protected static $redirectToCallback;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request));
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        // Admin Side
        if($request->routeIs('admin.login')){
            return route('admin.dashboard.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.rfidchecker.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.analytics.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.sections.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.courses.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.students.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.students.create');
        }

        if($request->routeIs('admin.login')){
            return route('admin.students.addtaguid');
        }

        if($request->routeIs('admin.login')){
            return route('admin.instructors.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.instructors.addtaguid');
        }

        if($request->routeIs('admin.login')){
            return route('admin.events.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.schedules.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.schedules.makeup');
        }

        if($request->routeIs('admin.login')){
            return route('admin.schedules.approvals');
        }

        if($request->routeIs('admin.login')){
            return route('admin.admins.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.admins.create');
        }

        if($request->routeIs('admin.login')){
            return route('admin.roles.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.roles.addpermission');
        }

        if($request->routeIs('admin.login')){
            return route('admin.permissions.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.logs.index');
        }

        if($request->routeIs('admin.login')){
            return route('admin.settings.index');
        }

        // Faculty Side
        if($request->routeIs('faculty.login')){
            return route('faculty.dashboard.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.attendances.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.attendances.current');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.events.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.courses.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.courses.blocked');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.students.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.schedules.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.schedules.makeup');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.seatplan.index');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.seatplan.assign');
        }

        if($request->routeIs('faculty.login')){
            return route('faculty.settings.index');
        }

        // Student Side
        if($request->routeIs('user.login')){
            return route('user.dashboard.index');
        }

        if($request->routeIs('user.login')){
            return route('user.schedules.index');
        }

        if($request->routeIs('user.login')){
            return route('user.courses.index');
        }

        if($request->routeIs('user.login')){
            return route('user.courses.enrolled');
        }

        if($request->routeIs('user.login')){
            return route('user.settings.index');
        }

        return static::$redirectToCallback
            ? call_user_func(static::$redirectToCallback, $request)
            : $this->defaultRedirectUri();
    }

    /**
     * Get the default URI the user should be redirected to when they are authenticated.
     */
    protected function defaultRedirectUri(): string
    {
        foreach (['dashboard', 'home'] as $uri) {
            if (Route::has($uri)) {
                return route($uri);
            }
        }

        $routes = Route::getRoutes()->get('GET');

        foreach (['dashboard', 'home'] as $uri) {
            if (isset($routes[$uri])) {
                return '/'.$uri;
            }
        }

        return '/';
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
