<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Pendaftaran"
        ];

        if (Session::get('penduduk')) {
            return redirect('penduduk');
        } else {
            return view('auth.register', $data);
        }
    }

    public function proccess(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:tb_penduduk,nik',
            'jk' => 'required',
            'wn' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'image' => 'image|required|mimes:png,jpg,jpeg,gif'
        ]);

        $penduduk = Penduduk::where('nik', $request->nik)->first();

        if ($penduduk) {
            return back()->with('message', '<div class="alert alert-danger">Penduduk telah terdaftar!</div>');
        } else {
            $validate['kewarganegaraan'] = $validate['wn'];
            $validate['status'] = 0;
            $validate['password'] = bcrypt($validate['password']);

            if ($request->file('image')) {
                $validate['image'] = $request->file('image')->store('penduduk');
            }

            Penduduk::create($validate);

            return back()->with('message', '<div class="alert alert-success">Data berhasil disimpan!</div>');
        }
    }
}
