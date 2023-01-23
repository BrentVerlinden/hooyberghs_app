@extends('layouts.template')
<head><script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> </head>

@section('main')
    <div class="fixedmt"></div>
    <h1>Welkom  {{ auth()->user()->name }}!</h1>
    @if(auth()->user()->admin)
        <div class="mt-5">    <a href="/admin/pumpsettings" class="align-content-center text-center">Pompinstellingen werf</a> </div>

    @endif
    <br>
    @guest
        <p>Please login...</p>
    @endguest
        @auth
            <div class="row mt-3 mb-5">
                <div class="col-6">
                    <h2><span class="logged-in">●</span> Actieve pompen</h2><div class="circle_green">
                    </div>
                    <ul >
            @foreach($active_pumps ?? '' as $pump)
                            <li style="list-style: none"><a href="/user/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <h2><span class="logged-out">●</span> Inactieve pompen</h2>
                    <ul>
                        @foreach($inactive_pumps ?? '' as $pump)
                            <li style="list-style: none"><a href="/user/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
                <div class="border">
                    <h4 class="mt-2">Waterniveau</h4>
                <div id="chart_div2" class="mt-5"></div></div>

                <div class="border mt-4">
                    <h4 class="mt-2">Stroomverbruik</h4>
            <div id="chart_div" class="mt-5"></div></div>

            </div>
    @endauth

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart1() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Pump');
            data.addColumn('number', 'Stroom');

            var pumps = @json($pumps);
            var pumpData = {};
            pumps.forEach(function(pump) {
                pumpData[pump.pumpname] = {
                    sum: 0,
                    count: 0
                };
            });

            pumps.forEach(function(pump) {
                pump.powerconsumption.forEach(function(power_consumption) {
                    power_consumption.verbruik.forEach(function(verbruik) {
                        pumpData[pump.pumpname].sum += verbruik.verbruik;
                        pumpData[pump.pumpname].count++;
                    });
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
                hAxis: {

                },
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

        function drawChart2() {
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
                console.log();
                pumpData[pump.sensors[0].name] = {
                    lastData: 0,
                    firstData: 0
                };
            });

            pumps.forEach(function (pump) {
                pump.sensors.forEach(function (sensor) {
                    sensor.data.forEach(function (data) {
                        if (pumpData[pump.sensors[0].name].firstData == 0) {
                            pumpData[pump.sensors[0].name].firstData = data.data;
                        }
                        pumpData[pump.sensors[0].name].lastData = data.data;
                        total += data.data;
                        total_first += pumpData[pump.sensors[0].name].firstData;
                        count++;
                    });
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
                hAxis: {

                },
                vAxis: {
                    title: 'Waterniveau in m'
                },
                legend: { position: 'top', maxLines: 3 },
                series: {
                    0: { color: 'lightblue', labelInLegend: 'Huidige niveau' },
                    1: { color: '#000058', labelInLegend: 'Start niveau' },

                }
            };
            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div2'));

            chart.draw(data, options);
        }
    </script>

@endsection
