<div class="form-group row">
    <label for="umur" class="col-sm-3 col-form-label">Umur</label>
    <div class="col-sm-9">
        <input required name="umur" id="umur" class="form-control" type="text">
    </div>
</div>
<div class="form-group row">
    <label for="gambar" class="col-sm-3 col-form-label">Gambar Rumah</label>
    <div class="col-sm-9">
        <input required name="gambar[]" multiple max="4" id="gambar" class="form-control" type="file"
            accept="image/jpg, image/jpg">
    </div>
</div>
<div class="form-group row">
    <label for="nama_orangtua" class="col-sm-3 col-form-label">Nama Orang Tua</label>
    <div class="col-sm-9">
        <input required name="nama_orangtua" id="nama_orangtua" class="form-control" type="text">
    </div>
</div>
<div class="form-group row">
    <label for="umur_orangtua" class="col-sm-3 col-form-label">Umur Orang Tua</label>
    <div class="col-sm-9">
        <input required name="umur_orangtua" id="umur_orangtua" class="form-control" type="text">
    </div>
</div>
<div class="form-group row">
    <label for="pekerjaan_orangtua" class="col-sm-3 col-form-label">Pekerjaan Orang Tua</label>
    <div class="col-sm-9">
        <input required name="pekerjaan_orangtua" id="pekerjaan_orangtua" class="form-control" type="text">
    </div>
</div>
<div class="form-group row">
    <label for="jk_orangtua" class="col-sm-3 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-9">
        <select required name="jk_orangtua" id="jk" class="form-control">
            <option value="">- Pilih Jenis Kelamin -</option>
            <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="p" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="alamat_orangtua" class="col-sm-3 col-form-label">Alamat Orang Tua</label>
    <div class="col-sm-9">
        <input required name="alamat_orangtua" id="alamat_orangtua" class="form-control" type="text">
    </div>
</div>
