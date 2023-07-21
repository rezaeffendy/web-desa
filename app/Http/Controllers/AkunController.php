<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all()
        ];
        return view('akun.index', $data);
    }

    public function create()
    {
        return view('akun.create');
    }

    public function edit($id)
    {
        $data = [
            'user' => User::findOrFail($id)
        ];

        return view('akun.edit', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
            'name' => 'required'
        ]);

        $validate['password'] = bcrypt($request->password);

        User::create($validate);

        return redirect('admin/akun')->with('message', '<div class="alert alert-success">Update berhasil, password anda : <strong>' . $request->password . '</strong>!</div>');
    }

    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'name' => 'required'
        ]);

        $user = User::findOrFail($id);

        if (password_verify($validate['password'], $user->password)) {
            User::where('id', $user->id)->update([
                'email' => $request->email,
                'name' => $request->name,
            ]);

            return redirect('admin/akun')->with('message', '<div class="alert alert-success">Update berhasil!</div>');
        } else {
            return back()->with('message', '<div class="alert alert-danger">Password salah!</div>');
        }
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect('admin/akun')->with('message', '<div class="alert alert-success">Delete berhasil!</div>');
    }

    public function show()
    {
        if (Session::get('penduduk')) {
            $data = [
                'title' => "Profil",
                'penduduk' => Penduduk::where('id', Session::get('penduduk')->id)->first()
            ];
            return view('akun.show', $data);
        } else {
            return redirect('auth');
        }
    }

    public function proccess(Request $request)
    {
        $id = Session::get('penduduk')->id;

        $validate = $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'jk' => 'required',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,gif'
        ]);

        $penduduk = Penduduk::where('id', $id)->first();

        if ($request->file('image')) {
            // Storage::delete($penduduk->image);
            $validate['image'] = $request->file('image')->store('penduduk');
        }

        Penduduk::where('id', $id)->update($validate);

        return back()->with('message', '<div class="alert alert-success">Update berhasil!</div>');
    }
}
