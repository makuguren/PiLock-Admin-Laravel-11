<?php

namespace App\Http\Controllers\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredInstructorController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('instructor.auth.register');
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

        $instructor = Faculty::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($instructor));

        Auth::guard('instructor')->login($instructor);

        return redirect(route('instructor.dashboard.index', absolute: false));
    }
}
