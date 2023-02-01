@extends('layouts.template')
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"/>

</head>

@section('main')
    <div class="fixedmt"></div>
{{--    <h1>Welkom in {{$werf->name}}, {{ auth()->user()->name }}!</h1>--}}
    {{--    <h3>Ingelogd in {{$werf->name}}</h3>--}}
    @if(auth()->user()->admin)
        @if(count($pumps)>0)
            <div class="mt-2 text-left ml-4 txtbg"><a href="/admin/werf/{{ $werf->id }}/pumpsettings" style="color:#1C60AA " class="align-content-center text-center"><i class="fa-solid fa-gear"></i> Automatisatie</a>
            </div>

        @endif



    @endif
    <br>
    @guest
        <p>Please login...</p>
    @endguest
    @auth
        <div class="container-fluid pb-4 pt-2">
            <div class="row">
                @foreach($active_pumps ?? '' as $pump)
                    <div class="col-xl-3 col-lg-6">
                        <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large mr-3"><i class="fas fa-droplet"></i></div>
                                <div class="mb-4">
                                    <h3 class="card-title mb-0">{{ $pump->pumpname }}</h3>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h5 class="d-flex align-items-center mb-0">
                                            <p>{{$pump->location}}</p>
                                        </h5>
                                    </div>

                                    <div class="col-4 text-right">
                                        @if($werf->frequention == 1)
                                        <span>{{$pump->percentage}}% <i class="fa fa-arrow-up"></i></span>
                                        @else
                                            <span>Binair</span>
                                            @endif
                                    </div>
                                </div>
                                @if($werf->frequention == 1)
                                <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar"
                                         data-width="{{ $pump->percentage }}%"
                                         aria-valuenow="{{ $pump->percentage }}" aria-valuemin="0"
                                         aria-valuemax="100" style="width: {{ $pump->percentage }}%;"></div>
                                </div>
                                    @endif
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
                    @foreach($error_pumps ?? '' as $pump)
                        <div class="col-xl-3 col-lg-6">
                            <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">
                                <div class="card l-bg-orange-dark">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large mr-3"><i class="fas fa-wrench"></i></div>
                                        <div class="mb-4">
                                            <h3 class="card-title mb-0">{{ $pump->pumpname }}</h3>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h5 class="d-flex align-items-center mb-0">
                                                    <p>{{$pump->location}}</p>
                                                </h5>
                                            </div>

                                            <div class="col-4 text-right">
                                                    <span>Error</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @foreach($inactive_pumps ?? '' as $pump)
                        <div class="col-xl-3 col-lg-6">
                            <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">
                                <div class="card l-bg-cherry">
                                    <div class="card-statistic-3 p-4">
                                        <div class="card-icon card-icon-large mr-3"><i class="fas fa-power-off"></i></div>
                                        <div class="mb-4">
                                            <h3 class="card-title mb-0">{{ $pump->pumpname }}</h3>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                <h5 class="d-flex align-items-center mb-0">
                                                    <p>{{$pump->location}}</p>
                                                </h5>
                                            </div>

                                            <div class="col-4 text-right">
                                                @if($werf->frequention == 1)
                                                    <span>{{$pump->percentage}}% <i class="fa fa-arrow-up"></i></span>
                                                @else
                                                    <span>Binair</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
                {{--                            <li style="list-style: none"><a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>--}}


            </div>

        </div>
        @if(count($pumps)>0)
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-4 card-size">
                        <h4 class="mt-2">Waterniveau</h4>
                        <div id="chart_div2" class="mt-5"></div>
                    </div>
                </div>

                {{--            <div class="border col-lg-6 col-sm-12">--}}
                {{--                <h4 class="mt-2">Stroomverbruik</h4>--}}
                {{--                <div id="chart_div" class="mt-5"></div>--}}
                {{--            </div>--}}

            </div>
        @else
            <h1>Welkom op uw nieuwe werf: {{$werf->name}}</h1>
            <a href="/admin/werf/{{$werf->id}}/pumps/create" style="background-color: #1C60AA"  class="btn btn-primary mt-5">Pomp aanmaken</a>

        @endif

        <div class="row"></div>
        @if(count($logs) > 0)
        <div class="col-lg-12 col-sm-12">
            <div class="card mb-4">
            <div class="card-body p-3 pb-0">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="d-none d-md-table-cell">Naam</th>
                            <th>Beschrijving</th>
                            <th>Tijd</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                {{--                    <td class="d-none d-md-table-cell">{{ $user->id }}</td>--}}
                                <td class="d-none d-md-table-cell">{{ $log->nameLog }}</td>
                                <td class="">{{ $log->description }}</td>
                                <td>{{ date("d/m/Y H:i:s", strtotime($log->date)) }}</td>
                            </tr>
                            </form>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    {{ $logs->withQueryString()->links() }}--}}
                </div>

            </div>
            </div>
        </div>
        @else
            @if(count($pumps)>0)
                <p>Geen error logs gevonden</p>
            @endif

        @endif
    @endauth

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart1() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pump');
            data.addColumn('number', 'Huidge niveau');
            data.addColumn({type: 'string', role: 'style'});

            var pumps = @json($pumps);
            var pumpData = {};

            pumps.forEach(function (pump) {
                var pitName = pump.location;
                if (!pumpData[pitName]) {
                    pumpData[pitName] = { lastData: 0 };
                }
            });

            pumps.forEach(function (pump) {
                var pitName = pump.location;
                pump.sensor.sensordatas.forEach(function (sensor) {
                    pumpData[pitName].lastData = sensor.water_level;
                });
            });

            var dataArray = [];
            for (var pumpname in pumpData) {
                dataArray.push([pumpname, pumpData[pumpname].lastData, '#7bbded']);
            }
            data.addRows(dataArray);

            var options = {
                title: 'Waterniveau per put',
                hAxis: {},
                vAxis: { title: 'Waterniveau (TAW)' },
                legend: { position: 'top', maxLines: 3 },
                series: {
                    0: { color: '#7bbded', labelInLegend: 'Huidige waterniveau' },
                }
            };
            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div2')
            );

            chart.draw(data, options);
        }
        function drawChart2() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pump');
            data.addColumn('number', 'Stroom');

            var pumps = @json($pumps);

            var pumpData = {};
            pumps.forEach(function (pump) {

                pumpData[pump.pumpname] = {
                    sum: 0,
                    count: 0
                };
            });

            pumps.forEach(function (pump) {
                pump.powerconsumption.forEach(function (power_consumption) {
                    pumpData[pump.pumpname].sum += power_consumption.usage;
                    pumpData[pump.pumpname].count++;
                });
            });

            var dataArray = [];
            for (var pumpname in pumpData) {
                var averagePower = pumpData[pumpname].sum / pumpData[pumpname].count;
                dataArray.push([pumpname, averagePower]);
            }
            data.addRows(dataArray);

            var options = {
                title: 'Gemiddelde Stroomverbruik per Pomp',
                hAxis: {},
                vAxis: {
                    title: 'Stroom (kWh)'
                },
                series: {
                    0: {color: 'lightgray'}
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }


    </script>

@endsection
