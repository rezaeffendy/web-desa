<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Desa Krimun</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('login/images/Indramayu.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('adminlte/dist/css/adminlte.min.css') }}">
    <script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="{{ url('login/images/Indramayu.png') }}" alt="Logo Indramayu"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><b>Desa Krimun</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @include('widget.menu')

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item">
                        @if (Auth::user())
                            <a href="{{ url('auth/logout') }}" class="btn btn-sm btn-danger">Logout</a>
                        @else
                            <a href="{{ url('auth') }}" class="btn btn-sm btn-primary">Login</a>
                            <a href="{{ url('auth/register') }}" class="btn btn-sm btn-success">Daftar</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> {{ $title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if (!empty($title1))
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ $title1 }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $title }}</li>
                                @else
                                    <li class="breadcrumb-item active">{{ $title }}</li>
                                @endif
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Tampilan Gambar Bagian Atas -->
            <div class="content">
                <div class="container">
                    @if (Request::segment(1) == '')
                        @include('widget.slider')
                    @endif
                    <div class="row mt-3">
                        @yield('konten')
                        <!-- /.col-md-6 -->
                        <div class="col-lg-3">
                            <div id="jam" align="center"
                                style="margin:5px 0 5px 0; background:#b9eb07;border:3px double #ffffff;padding:3px;width:auto; color:#fff;">
                            </div>
                            {{-- Data Statistik Penduduk --}}
                            @include('widget.statistik')
                            {{-- Data Berita Terbaru Di bawah Penduduk --}}
                            @include('widget.berita')
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 Website Desa Krimun</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <!-- Bootstrap 4 -->
    <script src="{{ url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('adminlte/plugins') }}/highcharts/highcharts.js"></script>
    <script src="{{ url('adminlte/plugins') }}/highcharts/highcharts-3d.js"></script>
    <script type="text/javascript">
        $(function() {
            var chart_widget;
            $(document).ready(function() {
                chart_widget = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container_widget',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Jumlah Penduduk'
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    xAxis: {
                        categories: [
                            [
                                '{{ \App\Models\Penduduk::where('jk', 'L')->count() }} <br> LAKI-LAKI'
                            ],
                            [
                                '{{ \App\Models\Penduduk::where('jk', 'P')->count() }} <br> PEREMPUAN'
                            ],
                            ['{{ \App\Models\Penduduk::count() }} <br> Total'],
                        ]
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            colorByPoint: true
                        },
                        column: {
                            pointPadding: 0,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Populasi',
                        data: [
                            ['LAKI-LAKI',
                                {{ \App\Models\Penduduk::where('jk', 'L')->count() }}
                            ],
                            ['PEREMPUAN',
                                {{ \App\Models\Penduduk::where('jk', 'P')->count() }}
                            ],
                            ['Total', {{ \App\Models\Penduduk::count() }}],
                        ]
                    }]
                });
            });

        });
    </script>
    <script>
        window.setTimeout("renderDate()", 1);
        days = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
        months = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember");

        function renderDate() {
            var mydate = new Date();
            var year = mydate.getYear();
            if (year < 2000) {
                if (document.all)
                    year = "19" + year;
                else
                    year += 1900;

            }
            var day = mydate.getDay();
            var month = mydate.getMonth();
            var daym = mydate.getDate();
            if (daym < 10)
                daym = "0" + daym;
            var hours = mydate.getHours();
            var minutes = mydate.getMinutes();
            var seconds = mydate.getSeconds();

            if (hours <= 9)
                hours = "0" + hours;
            if (minutes <= 9)
                minutes = "0" + minutes;
            if (seconds <= 9)
                seconds = "0" + seconds;

            document.getElementById("jam").innerHTML = "<B>" + days[day] + ", " + daym + " " + months[month] + " " + year +
                "</B><br>" + hours + " : " + minutes + " : " + seconds;
            setTimeout("renderDate()", 1000)
        }
    </script>

    @yield('app_scripts')
</body>

</html>
