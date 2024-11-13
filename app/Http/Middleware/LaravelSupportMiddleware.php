<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Makuguren\Laravelsupport\LaravelSupport;
use Symfony\Component\HttpFoundation\Response;

class LaravelSupportMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $support = new LaravelSupport();
        $isActive = $support->activate();

        if ($isActive === true) {
            return $next($request);
        } elseif ($isActive !== false) {
            return abort(403, $isActive);
        }

        return $next($request);
    }
}
