<?php

namespace App\Http\Middleware\Archive;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorComponentLayout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        config(['livewire.layout' => 'archive.instructor.layouts.app']);
        return $next($request);
    }
}
