<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.index');
    }

    public function proses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        unset($credentials['captcha']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended("admin/dashboard");
        }

        return redirect()->back()->with("session", "Gagal Login");
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
