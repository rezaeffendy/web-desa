@php
$berita = \App\Models\Berita::paginate(8);
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="card-title text-bold">Galeri</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($berita as $berita)
                <div class="col-md-3">
                    <a href="{{ url('berita/' . $berita->slug) }}">
                        <img src="{{ url('storage/' . $berita->gambar) }}" width="100%" alt="{{ $berita->judul }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
