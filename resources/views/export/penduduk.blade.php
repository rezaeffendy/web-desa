<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Penduduk</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
            <th>Warga Negara</th>
            <th>Agama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Pekerjaan</th>
            <th>Alamat</th>
            <th>Terdata</th>
            <th>Foto KTP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penduduk as $penduduk)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $penduduk->nama }}</th>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->jk }}</td>
                <td>{{ $penduduk->kewarganegaraan }}</td>
                <td>{{ $penduduk->agama }}</td>
                <td>{{ $penduduk->tempat_lahir }}</td>
                <td>{{ date('d/m/Y', strtotime($penduduk->tgl_lahir)) }}</td>
                <td>{{ $penduduk->pekerjaan }}</td>
                <td>{{ $penduduk->alamat }}</td>
                <td>{{ date('d/m/Y', strtotime($penduduk->created_at)) }}</td>
                <td>{{ url('storage/'.$penduduk->image) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
