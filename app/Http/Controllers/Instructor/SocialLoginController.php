<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function toProvider(){
        return Socialite::driver('google_instructor')->redirect();
    }

    public function handleCallback(){
        // Check if the Configuration is Allow to Register Students via Google
        $appSetting = View::shared('appSetting');

        $user = Socialite::driver('google_instructor')->user();
        $email = $user->getEmail();

        // Access the user's raw data for getting the first name and last name
        $firstName = $user->user['given_name'];
        $lastName = $user->user['family_name'];

        // Validate if the email ends with "@cspc.edu.ph"
        if (!str_ends_with($email, '@my.cspc.edu.ph')) {
            abort(403, 'Access denied: Your email domain is not authorized to access this system. Please contact the administrator for further assistance.');
        }
        $findInstructor = Faculty::where('google_id', $user->id)->first();

        if($findInstructor){
            Auth::guard('instructor')->login($findInstructor);
            Session::regenerate();
        } elseif ($appSetting->isRegStud == '1') {
            $user = Faculty::updateOrCreate([
                'email' => $user->getEmail(),
            ], [
                'name' => $user->getName(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'google_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
                'password' => bcrypt(rand(1000,9999)),
                'isDefaultPass' => '0'
            ]);

            Auth::guard('instructor')->login($user);
            Session::regenerate();
        } else {
            abort(404);
        }

        return redirect()->intended('instructor/dashboard');
    }
}

