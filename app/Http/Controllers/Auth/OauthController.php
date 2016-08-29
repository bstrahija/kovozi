<?php

namespace App\Http\Controllers\Auth;

use Auth, Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Users\UserRepository;

class OauthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, UserRepository $users)
    {
        $socialUser = Socialite::driver($provider)->user();

        // Create/update user and login
        $user = $users->createOrUpdateFromSocial($socialUser, $provider);
        Auth::loginUsingId($user->id, true);

        return redirect()->route('home');
    }
}
