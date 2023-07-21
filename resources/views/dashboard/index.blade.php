@extends('template')

@section('app_contents')
    <div class="row top_tiles">
        <div class="col-sm-12">
            <div class="alert bg-success text-white mb-3">
                <p style="font-size: 20px; margin-bottom: 0">Selamat Datang <b>{{ Session::get('penduduk') ? Session::get('penduduk')->nama : auth()->user()->name }}</b></p>
            </div>
            @if (!Session::get('penduduk'))
            <div class="animated flipInY col-md-6">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="count">{{ $penduduk }}</div>
                    <a href="{{ url('admin/kependudukan') }}">
                        <h3>Jumlah Penduduk</h3>
                    </a>
                </div>
            </div>
            <div class="animated flipInY col-md-6">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="count">{{ $surat }}</div>
                    <h3>Jumlah Permintaan Surat</h3>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
