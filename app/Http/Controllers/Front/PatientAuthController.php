<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    public function showLogin()
    {
        return view('front.Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('patient')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid Email',
            'password' => 'Invalid Password',
        ]);
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect('/patient/login');
    }
}
