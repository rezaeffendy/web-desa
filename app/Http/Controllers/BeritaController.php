<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'berita' => Berita::all()
        ];

        return view('berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
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
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:png,jpg,jpeg,gif'
        ]);

        if ($request->file('gambar')) {
            $validate['gambar'] = $request->file('gambar')->store('berita');
        }

        $validate['slug'] = Str::slug($validate['judul']);

        Berita::create($validate);

        return redirect('admin/berita')->with('message', '<div class="alert alert-success">Tambah berhasil!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */

    public function showAll()
    {
        $data = [
            'title' => 'Daftar Berita',
            'title1' => 'Home',
            'data_berita' => Berita::latest()->paginate(12)
        ];

        return view('landing.berita.all', $data);
    }

    public function show($slug)
    {
        $data = [
            'title' => 'Lihat Berita',
            'title1' => 'Home',
            'berita' => Berita::where('slug', $slug)->first()
        ];

        return view('landing.berita.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = [
            'berita' => Berita::where('slug', $slug)->first()
        ];

        return view('berita.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg,gif'
        ]);

        $berita = Berita::where('id', $id)->first();

        if ($request->file("gambar")) {
            Storage::delete($berita->gambar);

            $gambar = $request->file('gambar')->store('berita');

            $berita->update([
                'gambar' => $gambar
            ]);
        }

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
        ]);

        return redirect('admin/berita')->with('message', '<div class="alert alert-success">Update berhasil!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::where('id', $id)->first();

        Storage::delete($berita->gambar);

        $berita->delete();

        return redirect('admin/berita')->with('message', '<div class="alert alert-success">Delete berhasil!</div>');
    }
}