<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SettingsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View Settings', only: ['index']),
            new Middleware('permission:Update Settings', only: ['saveSettings', 'updateAdminProfile']),
        ];
    }

    public function index(Request $request){
        $setting = Setting::first();
        return view('admin.settings.index', [
            'user' => $request->user(),
            'setting' => $setting
        ]);
    }

    public function saveSettings(Request $request){
        $setting = Setting::first();
        if($setting){
            //Update Settings Configuration
            $setting->update([
               'website_title' => $request->website_title,
            ]);
            toastr()->success('Settings Saved Successfully');
            return redirect()->back();
        } else {
            //Save Settings Configuration
            Setting::create([
                'website_title' => $request->website_title,
            ]);
            toastr()->success('Settings Saved Successfully');
            return redirect()->back();
        }
    }

    public function updateAdminProfile(ProfileUpdateRequest $request){
        $adminprofile = Admin::where('id', Auth::user()->id);
        $validatedData = $request->validated();

        $adminprofile->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'admin_theme' => $validatedData['admin_theme']
        ]);

        toastr()->success('Profile Updated Successfully');
        return redirect()->back();
    }
}
