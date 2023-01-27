@extends('layouts.template')
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"/>

</head>

@section('main')
    <div class="fixedmt"></div>
    <h1>Welkom in {{$werf->name}}, {{ auth()->user()->name }}!</h1>
    {{--    <h3>Ingelogd in {{$werf->name}}</h3>--}}
    @if(auth()->user()->admin)
        <div class="mt-2"><a href="/admin/werf/{{ $werf->id }}/pumpsettings" class="align-content-center text-center">Pompinstellingen
                werf</a></div>

    @endif
    <br>
    @guest
        <p>Please login...</p>
    @endguest
    @auth
        <div class="container-fluid py-4">
            <div class="row">
                @foreach($active_pumps ?? '' as $pump)
                    <div class="col-xl-3 col-lg-6">
                        <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-droplet"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">{{ $pump->pumpname }}</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            @if($pump->status)
                                                <p>Actief</p>
                                            @else
                                                <p>Inactief</p>
                                            @endif
                                        </h2>
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
                @foreach($inactive_pumps ?? '' as $pump)
                        <div class="col-xl-3 col-lg-6">
                            <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">
                            <div class="card l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-droplet"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">{{ $pump->pumpname }}</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                @if($pump->status)
                                                    <p>Actief</p>
                                                @else
                                                    <p>Inactief</p>
                                                @endif
                                            </h2>
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
                {{--                            <li style="list-style: none"><a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>--}}


            </div>
        </div>
        <div>
            <div class="border">
                <h4 class="mt-2">Waterniveau</h4>
                <div id="chart_div2" class="mt-5"></div>
            </div>

            <div class="border mt-4">
                <h4 class="mt-2">Stroomverbruik</h4>
                <div id="chart_div" class="mt-5"></div>
            </div>

        </div>
    @endauth

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart1() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pump');
            data.addColumn('number', 'Huidige niveau');
            data.addColumn('number', 'Waterlevel');
            data.addColumn({type: 'string', role: 'style'});

            var pumps = @json($pumps);
            var pumpData = {};
            var total = 0;
            var total_first = 0;
            var count = 0;

            pumps.forEach(function (pump) {

                var sensorName = pump.sensor.name;

                if (!pumpData[sensorName]) {
                    pumpData[sensorName] = {
                        lastData: 0,
                        firstData: 0
                    };
                }

            });

            pumps.forEach(function (pump) {
                var sensorName = pump.sensor.name;
                console.log(pump.sensor.sensordatas);
                pump.sensor.sensordatas.forEach(function (sensor) {


                    if (pumpData[sensorName].firstData == 0) {
                        pumpData[sensorName].firstData = sensor.water_level;
                    }
                    pumpData[sensorName].lastData = sensor.water_level;
                    total += sensor.water_level;
                    total_first += pumpData[sensorName].firstData;
                    count++;
                });
            });


            var dataArray = [];
            for (var pumpname in pumpData) {
                dataArray.push([pumpname, pumpData[pumpname].lastData, pumpData[pumpname].firstData, '#000058']);
            }
            var average = total / count;
            var average_first = total_first / count;
            dataArray.push(["Waterniveau werf", average, average_first, 'darkgray']);
            data.addRows(dataArray);

            var options = {
                title: 'Waterniveau per put',
                hAxis: {},
                vAxis: {
                    title: 'Waterniveau in m'
                },
                legend: {position: 'top', maxLines: 3},
                series: {
                    0: {color: 'lightblue', labelInLegend: 'Huidige niveau'},
                    1: {color: '#000058', labelInLegend: 'Start niveau'},

                }
            };
            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div2'));

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
