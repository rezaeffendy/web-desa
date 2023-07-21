<form action="{{ url('admin/vaksin/' . $vaksin->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="form-group">
            <label for="penduduk">Pilih Penduduk</label>
            <select class="form-control" style="width: 100%" name="penduduk" id="penduduk">
                <option value="">Pilih Penduduk</option>
                @foreach ($penduduk as $penduduk)
                    <option value="{{ $penduduk->id }}" {{ $penduduk->id == $vaksin->id_penduduk ? 'selected' : '' }}>
                        {{ $penduduk->nik }} - {{ $penduduk->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dosis">Pilih Dosis</label>
            <select class="form-control" name="dosis" id="dosis">
                <option value="">Pilih Dosis</option>
                <option value="Vaksin 1 (Sinovac)"
                    {{ 'Vaksin 1 (Sinovac)' == $vaksin->jenis_vaksin ? 'selected' : '' }}>Vaksin 1 (Sinovac)</option>
                <option value="Vaksin 2 (Sinovac)"
                    {{ 'Vaksin 2 (Sinovac)' == $vaksin->jenis_vaksin ? 'selected' : '' }}>Vaksin 2 (Sinovac)</option>
                <option value="Vaksin 3 (Booster)"
                    {{ 'Vaksin 3 (Booster)' == $vaksin->jenis_vaksin ? 'selected' : '' }}>Vaksin 3 (Booster)</option>
            </select>
        </div>
        <div class="form-group">
            <img src="{{ url('storage/'.$vaksin->sertifikat) }}" width="100%">
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
        <button class="btn btn-sm btn-primary">Simpan</button>
    </div>
</form>
