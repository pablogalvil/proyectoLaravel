<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $rol = $request->user()->role;

        if ($request->user()->hasVerifiedEmail()) {
            if ($rol == 'admin') {
                return redirect()->intended(route('podcast.listarPodcastAdmin', absolute: false).'?verified=1');
            } else {
                return redirect()->intended(route('podcast.listar', absolute: false).'?verified=1');
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
