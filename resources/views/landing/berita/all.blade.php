@extends('landing')

@section('konten')
    <div class="col-lg-9">
        <div class="row">
            @foreach ($data_berita as $berita)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="{{ url('storage/' . $berita->gambar) }}" height="200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $berita->judul }}</h5>
                            <p class="card-text"></p>
                            <a href="{{ url('berita/' . $berita->slug) }}"
                                class="btn btn-primary form-control">Selanjutnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $data_berita->links() }}
    </div>
@endsection
