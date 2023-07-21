@extends('template')

@section('app_title', Session::get('penduduk') ? "Permohonan Surat" : 'Daftar Permohonan')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Session::get('penduduk') ? url('penduduk') : url('admin/dashboard') }}">Dashboard</a></li>
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
                    <div class="pull-right">
                        <a href="" class="btn btn-dark btn-sm" data-target="#modal-tambah-permohonan" data-toggle="modal">Tambah Permohonan</a>
                    </div>
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
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>No. Telepon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $item)
                                            @php
                                                $cek = unserialize($item->data);
                                                // dd($cek['nama']);
                                            @endphp
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $cek['nama'] }}</td>
                                                <td>{{ $cek['nik'] }}</td>
                                                <td>{{ $cek['telepon'] }}</td>
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-text="true"
        id="modal-tambah-permohonan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($vaksin)
                <form action="{{ url('penduduk/formulir') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input required type="text" name="nama" value="{{ $penduduk->nama }}" class="form-control" readonly
                                    id="nama">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">Tipe Surat</label>
                            <div class="col-sm-9">
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="lkp">Laporan Keterangan Pendatang</option>
                                    <option value="skd">Surat Keterangan Domisili</option>
                                    <option value="skm">Surat Keterangan Menikah</option>
                                    <option value="sknn">Surat Keterangan Numpang Nikah</option>
                                    <option value="sktm">Surat Keterangan Tidak Mampu</option>
                                    <option value="sku">Surat Keterangan Usaha</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input required name="nik" id="nik" value="{{ $penduduk->nik }}" class="form-control"
                                    type="text" maxlength="16" minlength="16">
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
                            <div class="col-sm-5">
                                <input required name="tempat_lahir" id="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                                    class="form-control" type="text">
                            </div>
                            <div class="col-sm-4">
                                <input required name="tgl_lahir" id="tgl_lahir" value="{{ $penduduk->tgl_lahir }}"
                                    class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row" hidden>
                                <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                <input required name="jk" id="jk" value="{{ $penduduk->jk }}"
                                    class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="wn" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input required name="wn" id="wn" value="{{ $penduduk->kewarganegaraan }}"
                                    class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row" hidden>
                                <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                                <div class="col-sm-9">
                                    <input required name="agama" id="agama" value="{{ $penduduk->agama }}"
                                        class="form-control" type="text">
                                </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                            <div class="col-sm-9">
                                <input required name="pekerjaan" id="pekerjaan" value="{{ $penduduk->pekerjaan }}"
                                    class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-3 col-form-label">No WA</label>
                            <div class="col-sm-9">
                                <input required name="telepon" id="telepon" value="{{ old('telepon') }}"
                                    class="form-control" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea required name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea required name="alamat" id="alamat" class="form-control" rows="3">{{ $penduduk->alamat }}</textarea>
                            </div>
                        </div>
                        <div id="data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-times"></i> Kembali
                        </button>
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
                @else
                <div class="alert alert-danger">Harap isi data vaksin terlebih dahulu</div>
                <form action="{{ url('penduduk/vaksin/') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="penduduk" value="{{ $penduduk->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dosis">Pilih Dosis</label>
                            <select class="form-control" name="dosis" id="dosis">
                                <option value="">Pilih Dosis</option>
                                <option value="Vaksin 1 (Sinovac)">Vaksin 1 (Sinovac)</option>
                                <option value="Vaksin 2 (Sinovac)">Vaksin 2 (Sinovac)</option>
                                <option value="Vaksin 3 (Booster)">Vaksin 3 (Booster)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">Sertifikat Vaksin</label>
                            <input type="file" class="form-control" name="sertifikat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-times"></i> Kembali
                        </button>
                        <button class="btn btn-sm btn-primary">Tambah</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('app_scripts')
<script>
    $(function() {
        $("#tipe").on("change", function () {
            let tipe = $(this).val();
            $.get("{{ url('penduduk/formulir/') }}/"+tipe, function (data) {
                $("#data").html(data)
            })
        })
    })
</script>
@endsection
