@extends('landing')

@php
// dd(Request::segment(2));
@endphp

@section('konten')
    <link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <div class="col-lg-9">
        @if (session('message'))
            {!! session('message') !!}
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @php

            @endphp
        @endif
        <form action="{{ url('formulir/' . Request::segment(2)) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input required type="text" name="nama" value="{{ old('nama') }}" class="form-control"
                                id="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input required name="nik" id="nik" value="{{ old('nik') }}" class="form-control"
                                type="text" maxlength="16" minlength="16">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input required name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                class="form-control" type="text">
                        </div>
                        <div class="col-sm-4">
                            <input required name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}"
                                class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select required name="jk" id="jk" class="form-control">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="p" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wn" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                        <div class="col-sm-9">
                            <select required name="wn" id="wn" class="form-control">
                                <option value="">- Pilih Kewarganegaraan -</option>
                                <option value="WNI" {{ old('wn') == 'WNI' ? 'selected' : '' }}>WNI (Warga Negara
                                    Indonesia)</option>
                                <option value="WNA" {{ old('wn') == 'WNA' ? 'selected' : '' }}>WNA (Warga Negara
                                    Asing)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select required name="agama" id="agama" class="form-control">
                                <option value="">- Pilih Agama -</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Protestan" {{ old('agama') == 'Protestan' ? 'selected' : '' }}>Kristen
                                    Protestan
                                </option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Kristen
                                    Katolik
                                </option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>
                                    Hindu
                                </option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>
                                    Buddha
                                </option>
                                <option value="Kong Hu Cu" {{ old('agama') == 'Kong Hu Cu' ? 'selected' : '' }}>

                                    Kong Hu Cu
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                        <div class="col-sm-9">
                            <input required name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
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
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea required name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    @if (Request::segment(2) == 'sktm')
                        @include('landing.formulir.input.gambar')
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button class="btn btn-sm btn-primary pull-right">Simpan</button>
                            <button class="btn btn-sm btn-warning text-white" type="reset">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('app_scripts')
    <script src="{{ url('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        penduduk(2);

        $('.select2').select2()

        let nilai = 0;

        function penduduk(value) {
            $("#form").empty();
            if (value == 1) {
                nilai = value;
                $('label[for="penduduk1"]').addClass('active');
                $('label[for="penduduk2"]').removeClass('active');
                $('#data_penduduk').show()
            } else {
                $('label[for="penduduk2"]').addClass('active');
                $('label[for="penduduk1"]').removeClass('active');
                $('#data_penduduk').hide()

                $.get("{{ url('api/v1/form/' . Request::segment(2)) }}/" + value + '/0', function(data) {
                    $("#form").html(data);
                });
            }
        }

        function pilihPenduduk(value) {
            $.get("{{ url('api/v1/form/' . Request::segment(2)) }}/" + nilai + '/' + value, function(data) {
                $("#form").html(data);
            });
        }
    </script>
@endsection
