<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $rol = $request->user()->role;

        if ($rol == 'admin') {
            $ruta = 'podcast.listarPodcastAdmin';
        } else {
            $ruta = 'podcast.listar';
        }
        
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route($ruta, absolute: false))
                    : view('auth.verify-email');
    }
}
