<?php

namespace App\Http\Controllers\Archive\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Archive\Auth\InstructorLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('archive.instructor.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(InstructorLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('archive.instructor.dashboard.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('archive_instructor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
