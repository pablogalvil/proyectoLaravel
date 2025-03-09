<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
    function github_redirect(){
        return Socialite::driver('github')->redirect();
    }

    function github_callback(){
        $userGithub = Socialite::driver('github')->stateless()->user();

        $name = $userGithub->name ?? $userGithub->nickname ?? 'UsuarioDesconocido';

        if(!User::where('email', $userGithub->email)->exists()){
            $user = User::updateOrCreate([
                'name' => $name,
                'email' => $userGithub->email,
                'image' => $userGithub->avatar,
                'password' => $userGithub->email,
                'role' => 'user'
            ]);

            Auth::login($user);
        }else{
            $user = User::where('email', $userGithub->email)->first();
            Auth::login($user);
        }

        return redirect('/podcast');
    }
}
