@extends('template')

@section('app_title', 'Tambah Berita')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/berita') }}">Daftar Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('app_title')</li>
            </ol>
        </nav>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                    <a href="{{ url('admin/berita') }}" class="btn btn-warning btn-sm pull-right">Kembali</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form action="{{ url('admin/berita') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-8">
                <div class="x_panel">
                    <div class="x_title">
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul"
                                    value="{{ old('judul') }}">
                            </div>
                            {{-- Text Editor Berita --}}
                            <div class="col-md-12 col-sm-12 mt-3">
                                <label for="konten">Konten</label>
                                <textarea name="konten" id="konten">{{ old('konten') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="x_panel">
                    <div class="x_title">
                    </div>
                    <div class="x_content">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-sm btn-primary mt-3">Tambah</button>
                        <button type="reset" class="form-control btn btn-sm btn-warning text-white mt-3">Batal</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('app_scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        // $(document).ready(function() {
        //     $("#editor-one").keyup(function() {
        //         $("#konten").html(this.innerHTML)
        //     })
        // })
    </script>

    <script>
        tinymce.init({
            selector: '#konten',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
@endsection
