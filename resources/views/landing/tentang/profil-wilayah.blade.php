@extends('landing')

@section('konten')
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Batas</th>
                            <th scope="col">Desa/Kelurahan</th>
                            <th scope="col">Kecamatan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Sebelah Utara</th>
                            <td>Cemara Kulon</td>
                            <td>Losarang</td>

                        </tr>
                        <tr>
                            <th>Sebelah Selatan</th>
                            <td>Manggungan</td>
                            <td>Terisi</td>
                        </tr>
                        <tr>
                            <th>Sebelah Timur</th>
                            <td>Puntang</td>
                            <td>Losarang</td>
                        </tr>
                        <tr>
                            <th>Sebelah Barat</th>
                            <td>Losarang</td>
                            <td>Losarang</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
