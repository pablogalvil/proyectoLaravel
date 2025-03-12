<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Mostrar el perfil del usuario
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    // Mostrar la vista para editar
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // Actualizar los datos del perfil
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->user()->fill($request->validated());

        // Verificar si el email ha cambiado
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->hasFile('image')) {

            //Eliminamos la imagen anterior
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            //Definimos la ruta especifica para este Podcast
            $carpetaUser = 'image/user' . $user->id;

            //Guardamos la imagen en el hd y obtenemos la ruta completa
            $imagePath = $request->file('image')->store($carpetaUser, 'public');

            //Hay que añadir la ruta de la imagen a los datos que se van a 
            //insertar en bd
            $request->user()->update(['image' => $imagePath]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // Eliminar el usuario
    public function destroy(): RedirectResponse
    {

        $user = User::findOrFail(Auth::user()->id);
         // Eliminar usuario
        $user->delete();

        // Logout
        Auth::logout();


        return Redirect::to('/');
        
    }
}
