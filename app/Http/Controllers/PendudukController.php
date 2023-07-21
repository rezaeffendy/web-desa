<?php

namespace App\Http\Controllers;

use App\Exports\PendudukExport;
use App\Imports\PendudukImport;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'penduduk' => Penduduk::where('status', 1)->get(),
        ];

        return view('penduduk.index', $data);
    }

    public function view()
    {
        $data = [
            'penduduk' => Penduduk::where('status', 0)->orWhere('status', null)->get()
        ];

        return view('penduduk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $validate['status'] = 1;
            $validate['password'] = bcrypt($validate['password']);

            if ($request->file('image')) {
                $validate['image'] = $request->file('image')->store('penduduk');
            }

            Penduduk::create($validate);

            return redirect('admin/penduduk/tetap')->with('message', '<div class="alert alert-success">Tambah berhasil!</div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'penduduk' => Penduduk::findOrFail($id)
        ];

        return view('penduduk.edit', $data);
    }

    public function reset(Request $request, $id)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $penduduk = Penduduk::findOrFail($id);

        $penduduk->password = bcrypt($request->password);
        $penduduk->save();

        return redirect('admin/penduduk/tetap')->with('message', '<div class="alert alert-success">Reset password berhasil!</div>');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
            Storage::delete($penduduk->image);
            $validate['image'] = $request->file('image')->store('penduduk');
        }

        Penduduk::where('id', $id)->update($validate);

        return redirect('admin/penduduk/tetap')->with('message', '<div class="alert alert-success">Update berhasil!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::where('id', $id)->first();
        Storage::delete($penduduk->image);
        $penduduk->delete();

        return redirect('admin/penduduk/tetap')->with('message', '<div class="alert alert-success">Delete berhasil!</div>');
    }

    /**
     * Import the specified resource in storage
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PendudukImport, $request->file('excel'));

        return back()->with('message', '<div class="alert alert-success">Upload berhasil!</div>');
    }

    /**
     * Export the specified resource in storage
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export()
    {
        return Excel::download(new PendudukExport, date('Y_m_d') . '_' . time() . '_REKAP_DATA_PENDUDUK_DESA_KRIMUN.xlsx');
    }

    public function validasi($id)
    {
        $penduduk = Penduduk::where('id', $id)->first();

        $penduduk->status = 1;
        $penduduk->save();

        return redirect('admin/penduduk/baru')->with('message', '<div class="alert alert-success">Update berhasil!</div>');
    }
}
