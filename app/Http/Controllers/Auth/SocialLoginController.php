<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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

            // Descargar la imagen de GitHub y guardarla
            $imageContents = Http::get($userGithub->avatar)->body();
            $imagePath = 'imagenes/user/' . $user->id . '/avatar.jpg'; // Ruta de almacenamiento

            Storage::disk('public')->put($imagePath, $imageContents);

            // Guardar la ruta en la base de datos
            $user->update(['image' => $imagePath]);

        }else{
            $user = User::where('email', $userGithub->email)->first();
        }

        Auth::login($user);

        return redirect('/podcast');
    }
}
