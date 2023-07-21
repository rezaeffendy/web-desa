@extends('landing')

@section('konten')

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

        <div class="card">
            <div class="card-body">
                <form action="{{ url('auth') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-5">
                            <input name="nik" id="nik" value="{{ old('nik') }}" class="form-control"
                                type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-5">
                            <input name="password" id="password" class="form-control"
                                type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="captcha" class="col-sm-2 col-form-label">Captcha</label>
                        <div class="col-sm-5">
                            <div class="mb-3">{!! captcha_img() !!}</div>
                            <input name="captcha" id="captcha" value="{{ old('captcha') }}" class="form-control"
                                type="text" placeholder="masukan captcha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-5">
                            <button class="btn btn-sm btn-primary pull-right">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
