@php
$berita1 = \App\Models\Berita::paginate(1);
$berita2 = \App\Models\Berita::paginate(3);
@endphp
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @if ($berita1[0])
            <div class="carousel-item active">
                <a href="{{ url('berita/' . $berita1[0]->slug) }}">
                    <img src="{{ url('storage/' . $berita1[0]->gambar) }}" class="d-block w-50" height="300"
                        alt=" {{ $berita1[0]->judul }}">
                </a>
            </div>
            @foreach ($berita2 as $berita)
                <div class="carousel-item">
                    <a href="{{ url('berita/' . $berita->slug) }}">
                        <img src="{{ url('storage/' . $berita->gambar) }}" class="d-block w-50" height="300"
                            alt=" {{ $berita->judul }}">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </button>
</div>
