<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Faculty\ProfileUpdateRequest;

class SettingsController extends Controller
{
    public function index(Request $request){
        return view('faculty.settings.index', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(ProfileUpdateRequest $request){
        $facultyProfile = Faculty::where('id', Auth::user()->id);
        $validatedData = $request->validated();

        $facultyProfile->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'faculty_theme' => $validatedData['faculty_theme']
        ]);

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }
}
