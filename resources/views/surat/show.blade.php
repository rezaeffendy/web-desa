@extends('template')

@section('app_title', 'Daftar Permohonan')

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
                                            <th>No. Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($surat as $item)
                                            @php
                                                $penduduk = unserialize($item->data);
                                            @endphp
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $penduduk['nama'] }}</td>
                                                <td>{{ $penduduk['telepon'] }}</td>
                                                <td>
                                                    @if (Request::segment(3) == 'sktm')
                                                        <button onclick="showGambar({{ $item->id }})"
                                                            class="btn btn-sm btn-info"
                                                            data-target="#modal-show-gambar-sktm" data-toggle="modal"><i
                                                                class="fa fa-eye"></i></button>
                                                    @endif
                                                    <a href="{{ url('admin/surat/cetak/' . Request::segment(3) . '/' . $item->id) }}"
                                                        class="btn btn-sm btn-dark"><i class="fa fa-print"></i></a>
                                                    <a href="https://api.whatsapp.com/send?phone={{ $penduduk['telepon'] }}&text=Halo%20Bapak/Ibu Nama Surat Keterangan Domisili untuk Anda telah selesai dibuat. %0AMohon segera diambil di Balai Desa Krimun, serta membawa identitas KTP atau KK.%0ATerimakasih..."
                                                        class="btn btn-sm bg-success text-white"><i
                                                            class="fa fa-whatsapp"></i></a>
                                                    <form
                                                        action="{{ url('admin/surat/' . Request::segment(3) . '/' . $item->id) }}"
                                                        method="post" class="d-inline"
                                                        onsubmit="return confirm('Apakah anda yakin?')">
                                                        @method('delete')
                                                        @csrf
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
        id="modal-show-gambar-sktm">
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
    <script>
        $("#show-image").empty()

        function showGambar(params) {
            $.get('{{ url('api/v1/formulir/image') }}/' + params).then((response) => {
                $("#show-image").html(response)
            })
        }
    </script>
@endsection
