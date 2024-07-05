<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class SocialLoginController extends Controller
{
    public function toProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback(){
        $user = Socialite::driver('google')->user();
        $findUser = User::where('google_id', $user->id)->first();

        if($findUser){
            Auth::Login($findUser);
            Session::regenerate();
        } else {
            $user = User::updateOrCreate([
                'email' => $user->getEmail(),
            ], [
                'name' => $user->getName(),
                'google_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
                'password' => bcrypt(rand(1000,9999))
            ]);
            Auth::Login($user);
            Session::regenerate();
        }

        return redirect()->intended('dashboard');
    }
}
