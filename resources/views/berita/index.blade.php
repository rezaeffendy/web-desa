@extends('template')

@section('app_title', 'Daftar Berita')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('app_title')</li>
            </ol>
        </nav>
    </section>

    @if (session('message'))
        {!! session('message') !!}
    @endif

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-book"></i> @yield('app_title')
                    </h2>
                    <a href="{{ url('admin/berita/create') }}" class="btn btn-primary btn-sm pull-right">Tambah Berita</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Tanggal Rilis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($berita as $berita)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $berita->judul }}</td>
                                                <td>{{ $berita->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('admin/berita/' . $berita->slug . '/edit') }}"
                                                        class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ url('admin/berita/' . $berita->id) }}"
                                                        class="d-inline" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
