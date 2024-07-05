<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\ProfileUpdateRequest;

class SettingsController extends Controller
{
    public function index(Request $request){
        $sections = Section::all();
        return view('user.settings.index', [
            'user' => $request->user(),
            'sections' => $sections
        ]);
    }

    public function updateProfile(Request $request){
        $userprofile = User::where('id', Auth::user()->id);
        $validatedData = $request->validate([
            'student_id' => 'required|string',
            'section_id' => 'required|integer',
            'birthdate' => 'required',
            'user_theme' => 'nullable|string'
        ]);

        $userprofile->update([
            'user_theme' => $validatedData['user_theme'],
            'student_id' => $validatedData['student_id'],
            'section_id' => $validatedData['section_id'],
            'birthdate' => $validatedData['birthdate']
        ]);

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }
}
