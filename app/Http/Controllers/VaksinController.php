<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'vaksin' => Vaksin::all(),
            'penduduk' => Penduduk::all()
        ];

        return view('vaksin.index', $data);
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
        $request->validate([
            'penduduk' => "required",
            'dosis' => "required",
            'sertifikat' => 'required|image|mimes:png,jpg,jpeg,gif'
        ]);

        if ($request->file('sertifikat')) {
            $validate['sertifikat'] = $request->file('sertifikat')->store('sertifikat');
        }

        Vaksin::create([
            'id_penduduk' => $request->penduduk,
            'jenis_vaksin' => $request->dosis,
            'sertifikat' => $validate['sertifikat']
        ]);


        return back()->with('message', '<div class="alert alert-success">Tambah berhasil!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaksin  $vaksin
     * @return \Illuminate\Http\Response
     */
    public function show(Vaksin $vaksin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaksin  $vaksin
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaksin $vaksin)
    {
        $data = [
            'vaksin' => $vaksin,
            'penduduk' => Penduduk::all()
        ];

        return view('vaksin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaksin  $vaksin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaksin $vaksin)
    {
        $validate = $request->validate([
            'penduduk' => "required",
            'dosis' => "required",
        ]);

        if ($request->file('sertifikat')) {
            Storage::delete($vaksin->sertifikat);
            $validate['sertifikat'] = $request->file('sertifikat')->store('sertifikat');
        }

        $vaksin->update([
            'id_penduduk' => $request->penduduk,
            'jenis_vaksin' => $request->dosis,
            'sertifikat' => $validate['sertifikat']
        ]);

        return back()->with('message', '<div class="alert alert-success">Update berhasil!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaksin  $vaksin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaksin $vaksin)
    {
        Storage::delete($vaksin->sertifikat);
        $vaksin->delete();
        return back()->with('message', '<div class="alert alert-success">Hapus berhasil!</div>');
    }

    public function showImage($id)
    {
        $images = Vaksin::where('id', $id)->first();

        return view('vaksin.image', compact('images'));
    }
}
