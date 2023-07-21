@php
use Illuminate\Support\Str;
@endphp
@extends('template')

@section('app_title', 'Tambah Akun')

@section('app_contents')
    <section class="section">
        <h3>
            @yield('app_title')
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/akun') }}">Daftar Akun</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('app_title')</li>
            </ol>
        </nav>
    </section>

    <div class="clearfix"></div>

    @if ($errors->any())
        <div class="row">
            <div class="col-md-6">
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
    @if (session('message'))
        <div class="row">
            <div class="col-md-6">
                {!! session('message') !!}
                <div class="clearfix"></div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-book"></i> @yield('app_title')
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="row" action="{{ url('admin/akun') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Password Anda</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group pull-right">
                                <input class="btn btn-primary" type="submit" value="Simpan">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
