<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use App\Models\Penduduk;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormulirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipe)
    {
        $data = [
            'title1' => 'Home',
            'penduduk' => Penduduk::all()
        ];

        switch ($tipe) {
            case 'sku':
                $data['title'] = 'Formulir SKU';
                break;
            case 'skd':
                $data['title'] = 'Formulir SKD';
                break;
            case 'sktm':
                $data['title'] = 'Formulir SKTM';
                break;

            default:
                abort(404);
                break;
        }

        return view('landing.formulir.surat', $data);
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
    public function store(Request $request, $tipe)
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

        ]);

        $form = Formulir::create([
            'tipe' => $tipe,
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


        return back()->with('message', '<div class="alert alert-success">Permintaan berhasil!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function showImage($id)
    {
        $images = Upload::where('id_surat', $id)->get();

        return view('surat.image', compact('images'));
    }

    public function show($tipe)
    {
        $data = [
            'surat' => Formulir::where('tipe', $tipe)->get()
        ];

        return view('surat.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function cetak($tipe, $id)
    {
        $surat = Formulir::findOrFail($id);
        $penduduk = unserialize($surat->data);

        if (empty($penduduk['nama_suami'])) {
            $penduduk['nama_suami'] = "";
        }

        if (empty($penduduk['umur'])) {
            $penduduk['umur'] = "";
        }

        if (empty($penduduk['nama_orangtua'])) {
            $penduduk['nama_orangtua'] = "";
            $penduduk['jk_orangtua'] = "";
            $penduduk['alamat_orangtua'] = "";
            $penduduk['pekerjaan_orangtua'] = "";
            $penduduk['umur_orangtua'] = "";
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor('./dokumen/' . $tipe . '.docx');
        $template->setValues([
            'nama' => $penduduk['nama'],
            'ttl' => $penduduk['tempat_lahir'] . ', ' . date('d F Y', strtotime($penduduk['tgl_lahir'])),
            'nik' => $penduduk['nik'],
            'jk' => $penduduk['jk'],
            'agama' => $penduduk['agama'],
            'pekerjaan' => $penduduk['pekerjaan'],
            'keterangan' => $surat->keterangan,
            'nohp' => $penduduk['telepon'],
            'alamat' => $penduduk['alamat'],
            'tgl' => date('d'),
            'bln' => date('F'),
            'thn' => date('Y'),
            'kewarganegaraan' => $penduduk['wn'],
            'status' => "Menikah",
            'umur' => $penduduk['umur'],
            'nama_ortu' => $penduduk['nama_orangtua'],
            'jk_ortu' => $penduduk['jk_orangtua'],
            'alamat_ortu' => $penduduk['alamat_orangtua'],
            'pekerjaan_ortu' => $penduduk['pekerjaan_orangtua'],
            'umur_ortu' => $penduduk['umur_orangtua'],
            'nama_suami' => $penduduk['nama_suami'],
        ]);

        $template->saveAs('arsip/' . $penduduk['nik'] . '_' . strtoupper($penduduk['nama']) . ".docx");
        return response()->download(public_path('arsip/' . $penduduk['nik'] . '_' . strtoupper($penduduk['nama']) . ".docx"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulir $formulir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulir  $formulir
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipe, $id)
    {
        $penduduk = Formulir::findOrFail($id);

        $uploads = Upload::where('id_surat', $id)->get();

        foreach ($uploads as $upload) {
            Storage::delete($upload->image);
            $upload->delete();
        }

        $penduduk->delete();

        return back()->with('message', '<div class="alert alert-success">Delete berhasil!</div>');
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
