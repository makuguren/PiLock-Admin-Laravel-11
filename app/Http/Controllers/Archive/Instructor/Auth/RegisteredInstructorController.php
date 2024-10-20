<?php

namespace App\Http\Controllers\Archive\Instructor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Archive\Instructor;
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
        return view('archive.instructor.auth.register');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Instructor::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $instructor = Instructor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($instructor));

        Auth::guard('archive_instructor')->login($instructor);

        return redirect(route('archive.instructor.dashboard.index', absolute: false));
    }
}
