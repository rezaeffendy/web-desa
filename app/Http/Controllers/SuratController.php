<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Penduduk;
use App\Models\Upload;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'surat' => Formulir::where('nik', Session::get('penduduk')->nik)->get(),
            'penduduk' => Penduduk::where('id', Session::get('penduduk')->id)->first(),
            'vaksin' => Vaksin::where('id_penduduk', Session::get('penduduk')->id)->first()
        ];

        // dd($data['surat']);

        return view('surat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nik' => 'required',
            'jk' => 'required',
            'wn' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'keterangan' => 'required',
        ]);

        $tipe = $request->tipe;

        if ($tipe != 'skd') {
            $penduduk = Penduduk::where('nik', $request->nik)->first();

            if (!$penduduk) {
                return back()->with('message', '<div class="alert alert-danger">Anda bukan warga desa Krimun, silahkan hubungi petugas desa untuk mengkonfirmasi!</div>')->withInput();
            }
        }

        $data = serialize([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'jk' => $request->jk,
            'wn' => $request->wn,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'telepon' => $this->encodePhone($request->telepon),
            'umur' => $request->umur,
            'nama_orangtua' => $request->nama_orangtua,
            'jk_orangtua' => $request->jk_orangtua,
            'alamat_orangtua' => $request->alamat_orangtua,
            'pekerjaan_orangtua' => $request->pekerjaan_orangtua,
            'umur_orangtua' => $request->umur_orangtua,
            'nama_suami' => $request->nama_suami
        ]);

        $form = Formulir::create([
            'tipe' => $tipe,
            'nik' => $request->nik,
            'keterangan' => $request->keterangan,
            'data' => $data
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $key) {
                $img = $key->store('sktm');
                Upload::create([
                    'id_surat' => $form->id,
                    'image' => $img
                ]);
            }
        }

        return back()->with('message', '<div class="alert alert-success">Surat berhasil diajukan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tipe)
    {
        switch ($tipe) {
            case 'sktm':
                return view("landing.formulir.input.gambar");
                break;

            case 'skm':
                return view("landing.formulir.input.skm");
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function encodePhone($phone)
    {
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace("(", "", $phone);
        $phone = str_replace(")", "", $phone);
        $phone = str_replace(".", "", $phone);
        $phone = str_replace("-", "", $phone);

        if (!preg_match('/[^+0-9]/', trim($phone))) {
            if (substr(trim($phone), 0, 3) == "+62") {
                $phone = '62' . substr(trim($phone), 3);
            } elseif (substr(trim($phone), 0, 1) == 0) {
                $phone = '62' . substr(trim($phone), 1);
            }

            return $phone;
        }
    }
}
