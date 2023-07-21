@extends('template')

@section('app_title', 'Data Vaksin')

@section('app_contents')

    <link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

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
    @if ($errors->any())
        <div class="row">
            <div class="col-md-12">
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

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-book"></i> @yield('app_title')
                    </h2>
                    <div class="pull-right">
                        <a href="" class="btn btn-primary btn-sm" data-target="#tambah-data"
                            data-toggle="modal">Tambah Data</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <table class="table table-bordered table-striped" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jenis Vaksin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vaksin as $vaksin)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $vaksin->penduduk->nik }}</td>
                                                <td>{{ $vaksin->penduduk->nama }}</td>
                                                <td>{{ $vaksin->penduduk->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>{{ $vaksin->jenis_vaksin }}</td>
                                                <td>
                                                    <button onclick="showGambar({{ $vaksin->id }})"
                                                        class="btn btn-sm btn-info"
                                                        data-target="#modal-show-image" data-toggle="modal"><i
                                                            class="fa fa-eye"></i></button>
                                                    <a href="" data-target="#edit-data" data-toggle="modal"
                                                        class="btn btn-sm btn-warning"
                                                        onclick="showModalEdit({{ $vaksin->id }})"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form action="{{ url('admin/vaksin/' . $vaksin->id) }}"
                                                        class="d-inline" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-sm btn-danger"><i
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="tambah-data">
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
                <form action="{{ url('admin/vaksin') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="penduduk">Pilih Penduduk</label>
                            <select class="form-control" style="width: 100%" name="penduduk" id="penduduk">
                                <option value="">Pilih Penduduk</option>
                                @foreach ($penduduk as $penduduk)
                                    <option value="{{ $penduduk->id }}">{{ $penduduk->nik }} - {{ $penduduk->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="edit-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i>
                        <span>Edit Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="data"></div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
        id="modal-show-image">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i>
                        <span>Lihat Data</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="show-image"></div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                        <i class="fa fa-times"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app_scripts')
    <script src="{{ url('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        function showModalEdit(params) {
            $.get('{{ url('admin/vaksin') }}/' + params + '/edit', function(response) {
                $("#data").html(response);
            })
        }

        $("#show-image").empty()

        function showGambar(params) {
            $.get('{{ url('api/v1/sertifikat/image') }}/' + params).then((response) => {
                $("#show-image").html(response)
            })
        }

        $(function() {
            $(".select2").select2()

        })
    </script>
@endsection
