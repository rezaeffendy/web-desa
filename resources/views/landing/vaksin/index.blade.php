@extends('landing')

@section('konten')
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div id="container_vaksin" style="width: 100%; height: 300px; margin: 0 auto">
                </div>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jenis Vaksin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vaksins as $vaksin)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $vaksin->penduduk->nik }}</td>
                                    <td>{{ $vaksin->penduduk->nama }}</td>
                                    <td>{{ $vaksin->penduduk->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $vaksin->jenis_vaksin }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app_scripts')
    <script>
        $(function() {
            var chart_widget;
            $(document).ready(function() {
                chart_widget = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container_vaksin',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Jumlah Vaksinasi'
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    xAxis: {
                        categories: [
                            [
                                '{{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 1 (Sinovac)')->count() }} <br> Vaksin 1 (Sinovac)'
                            ],
                            [
                                '{{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 2 (Sinovac)')->count() }} <br> Vaksin 2 (Sinovac)'
                            ],
                            [
                                '{{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 3 (Booster)')->count() }} <br> Vaksin 3 (Booster)'
                            ],
                            ['{{ \App\Models\Vaksin::count() }} <br> Total'],
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
                            ['Vaksin 1 (Sinovac)',
                                {{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 1 (Sinovac)')->count() }}
                            ],
                            ['Vaksin 2 (Sinovac)',
                                {{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 2 (Sinovac)')->count() }}
                            ],
                            ['Vaksin 3 (Booster)',
                                {{ \App\Models\Vaksin::where('jenis_vaksin', 'Vaksin 3 (Booster)')->count() }}
                            ],
                            ['Total', {{ \App\Models\Vaksin::count() }}],
                        ]
                    }]
                });
            });

        });
    </script>
@endsection
