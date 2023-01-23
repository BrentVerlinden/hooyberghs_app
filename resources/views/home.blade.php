@extends('layouts.template')
<head><script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> </head>

@section('main')
    <div class="fixedmt"></div>
    <h1>Welkom  {{ auth()->user()->name }}!</h1>
    @if(auth()->user()->admin)
        <div class="mt-5">    <a href="/admin/werf/{{ $werf->id }}/pumpsettings" class="align-content-center text-center">Pompinstellingen werf</a> </div>

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
                            <li style="list-style: none"><a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <h2><span class="logged-out">●</span> Inactieve pompen</h2>
                    <ul>
                        @foreach($inactive_pumps ?? '' as $pump)
                            <li style="list-style: none"><a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
            <div id="chart_div" class="mt-5"></div></div>
    @endauth

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);


        function drawChart() {
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
                    power_consumption.power.forEach(function(power) {
                        pumpData[pump.pumpname].sum += power.power;
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
                    title: 'Pomp'
                },
                vAxis: {
                    title: 'Stroom (kWh)'
                },
                series: {
                    0: {color: '#096192'}
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>

@endsection
