<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Instructor\ProfileUpdateRequest;

class SettingsController extends Controller
{
    public function index(Request $request){
        return view('instructor.settings.index', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(ProfileUpdateRequest $request){
        $instructorprofile = Faculty::where('id', Auth::user()->id);
        $validatedData = $request->validated();

        $instructorprofile->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'instructor_theme' => $validatedData['instructor_theme']
        ]);

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }
}
