<?php

namespace App\Http\Controllers\Front\Auth;

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
        $user = auth('patient')->user();

        if (! $user) {
            return redirect()->route('front.login');
        }

        return $user->hasVerifiedEmail()
            ? redirect()->intended(route('front.home', absolute: false))
            : view('front.auth.verify-email');
    }
}
