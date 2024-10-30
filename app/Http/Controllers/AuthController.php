<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($user = User::where('email', $request->email)->first()) {
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => "The Provided password is incorrect."
                ])->onlyInput('password');
            }
            Auth::login($user);
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => "The Provided email address is not registered."
        ])->onlyInput('email');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
