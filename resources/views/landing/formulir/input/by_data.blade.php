<form action="{{ url('formulir/' . Request::segment(4)) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" value="{{ $penduduk->nama }}" class="form-control"
                        id="nama" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                <div class="col-sm-9">
                    <input name="nik" id="nik" value="{{ $penduduk->nik }}" class="form-control"
                        type="text" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat / Tanggal Lahir</label>
                <div class="col-sm-5">
                    <input name="tempat_lahir" id="tempat_lahir" value="{{ $penduduk->tempat_lahir }}"
                        class="form-control" type="text" readonly>
                </div>
                <div class="col-sm-4">
                    <input name="tgl_lahir" id="tgl_lahir" value="{{ $penduduk->tgl_lahir }}" class="form-control"
                        type="date" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <select name="jk" id="jk" class="form-control" readonly>
                        <option value="">- Pilih Jenis Kelamin -</option>
                        <option value="L" {{ $penduduk->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="p" {{ $penduduk->jk == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="wn" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                <div class="col-sm-9">
                    <select name="wn" id="wn" class="form-control" readonly>
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
                <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                    <select name="agama" id="agama" class="form-control" readonly>
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
                <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                <div class="col-sm-9">
                    <input name="pekerjaan" id="pekerjaan" value="{{ $penduduk->pekerjaan }}" class="form-control"
                        type="text" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-sm-3 col-form-label">No WA</label>
                <div class="col-sm-9">
                    <input required name="telepon" id="telepon" value="{{ old('telepon') }}" class="form-control"
                        type="number">
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
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" readonly>{{ $penduduk->alamat }}</textarea>
                </div>
            </div>
            @if (Request::segment(4) == 'sktm')
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
