@extends('template')

@section('app_title', $title ? $title : 'Edit Penduduk')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $title ? url('penduduk') : url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('app_title')</li>
            </ol>
        </nav>
    </section>

    @if ($errors->any())
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endif
    @if (session('message'))
        <div class="row">
            <div class="col-md-12">
                {!! session('message') !!}
                <div class="clearfix"></div>
            </div>
        </div>
    @endif

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-book"></i> @yield('app_title')
                    </h2>
                    <a href="{{ url('admin/penduduk/tetap') }}" class="btn btn-warning btn-sm pull-right">Kembali</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ url('penduduk/profil') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" value="{{ $penduduk->nama }}" class="form-control"
                                    id="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input name="nik" id="nik" value="{{ $penduduk->nik }}" class="form-control"
                                    type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat / Tanggal Lahir</label>
                            <div class="col-sm-5">
                                <input name="tempat_lahir" id="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                                    class="form-control" type="text">
                            </div>
                            <div class="col-sm-5">
                                <input name="tgl_lahir" id="tgl_lahir" value="{{ $penduduk->tgl_lahir }}"
                                    class="form-control" type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    <option value="L" {{ $penduduk->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="p" {{ $penduduk->jk == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-10">
                                <select name="kewarganegaraan" id="kewarganegaraan" class="form-control">
                                    <option value="">- Pilih Kewarganegaraan -</option>
                                    <option value="WNI" {{ $penduduk->kewarganegaraan == 'WNI' ? 'selected' : '' }}>
                                        WNI
                                        (Warga Negara
                                        Indonesia)</option>
                                    <option value="WNA" {{ $penduduk->kewarganegaraan == 'WNA' ? 'selected' : '' }}>
                                        WNA (Warga Negara
                                        Asing)
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                                <select name="agama" id="agama" class="form-control">
                                    <option value="">- Pilih Agama -</option>
                                    <option value="Islam" {{ $penduduk->agama == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Protestan" {{ $penduduk->agama == 'Protestan' ? 'selected' : '' }}>
                                        Kristen
                                        Protestan
                                    </option>
                                    <option value="Katolik" {{ $penduduk->agama == 'Katolik' ? 'selected' : '' }}>Kristen
                                        Katolik
                                    </option>
                                    <option value="Hindu" {{ $penduduk->agama == 'Hindu' ? 'selected' : '' }}>
                                        Hindu
                                    </option>
                                    <option value="Buddha" {{ $penduduk->agama == 'Buddha' ? 'selected' : '' }}>
                                        Buddha
                                    </option>
                                    <option value="Kong Hu Cu" {{ $penduduk->agama == 'Kong Hu Cu' ? 'selected' : '' }}>

                                        Kong Hu Cu
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                            <div class="col-sm-10">
                                <input name="pekerjaan" id="pekerjaan" value="{{ $penduduk->pekerjaan }}"
                                    class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $penduduk->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Foto KTP</label>
                            <div class="col-sm-10">
                                <img src="{{ url('storage/'.$penduduk->image) }}" alt="{{ $penduduk->nama }}" width="250">
                                <input name="image" id="image" value="{{ old('image') }}"
                                    class="form-control" type="file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-primary pull-right">Simpan</button>
                                <button class="btn btn-sm btn-warning text-white" type="reset">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('app_scripts')
@endsection
