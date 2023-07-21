<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Login"
        ];

        if (Session::get('penduduk')) {
            return redirect('penduduk');
        } else {
            return view('auth.login', $data);
        }
    }

    public function proccess(Request $request)
    {
        $validate = $request->validate([
            'nik' => 'required|max:16',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        $penduduk = Penduduk::where('nik', $validate['nik'])->first();

        if ($penduduk) {
            if (password_verify($validate['password'], $penduduk->password)) {
                Session::put('penduduk', $penduduk);
                return redirect('penduduk');
            } else {
                return back()->with('message', '<div class="alert alert-danger">Password anda salah!</div>');
            }
        } else {
            return back()->with('message', '<div class="alert alert-danger">Anda belum terdaftar!</div>');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
