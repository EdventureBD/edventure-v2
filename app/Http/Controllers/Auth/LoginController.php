<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        return $this->processLogin($user);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        return $this->processLogin($user);
    }

    protected function processLogin($data)
    {
        $user = User::where('email', $data->email)->first();
        if ($user) {
            Auth::login($user);
            return redirect(URL::previous());
           // return redirect(RouteServiceProvider::StudentHOME);
        } else {
            return redirect(route('login'))->withErrors(['msg' => 'Email not registered yet!']);
        }
    }
}
