<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $rol = $request->user()->roles->first()->name;

        if ($request->user()->hasVerifiedEmail()) {
            if ($rol == 'admin') {
                return redirect()->intended(route('podcast.listarPodcastAdmin', absolute: false).'?verified=1');
            } else {
                return redirect()->intended(route('podcast.listar', absolute: false).'?verified=1');
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($rol == 'admin') {
            return redirect()->intended(route('podcast.listarPodcastAdmin', absolute: false).'?verified=1');
        } else {
            return redirect()->intended(route('podcast.listar', absolute: false).'?verified=1');
        }
    }
}
