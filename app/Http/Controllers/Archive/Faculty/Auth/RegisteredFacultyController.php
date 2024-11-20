<?php

namespace App\Http\Controllers\Archive\Faculty\Auth;

use App\Http\Controllers\Controller;
use App\Models\Archive\Faculty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredFacultyController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('archive.faculty.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Faculty::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $faculty = Faculty::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($faculty));

        Auth::guard('archive_faculty')->login($faculty);

        return redirect(route('archive.faculty.dashboard.index', absolute: false));
    }
}
