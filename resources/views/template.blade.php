{{-- Kerangka Admin(Template Admin) --}}
@php
if (Session::get('penduduk')) {
    $user = \App\Models\Penduduk::where('id', Session::get('penduduk')->id)->first();
} else {
    $user = \App\Models\User::where('id', auth()->user()->id)->first();
}
// dd($user);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ url('login/images/Indramayu.png') }}">

    <title>Website Desa Krimun</title>

    @include('template.css')

    @yield('app_css')

    <style>
        label.error {
            color: red;
        }
    </style>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            @include('template.side')

            @include('template.nav')

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('app_contents')
            </div>
            <!-- /page content -->

            @include('template.foot')
        </div>
    </div>

    @include('template.js')

    @yield('app_scripts')

</body>

</html>
