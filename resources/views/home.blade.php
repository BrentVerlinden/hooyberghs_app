@extends('layouts.template')
<head><script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> </head>

@section('main')
    <div class="fixedmt"></div>
    <h1>Welkom  {{ auth()->user()->name }}!</h1>
    @if(auth()->user()->admin)
    <a href="/" class="align-content-center text-center">Pompinstellingen werf</a>
    @endif
    <br>
    @guest
        <p>Please login...</p>
    @endguest
        @auth
            <div class="row">
                <div class="col-6">
                    <h2>Actieve pompen</h2>
                    <ul >
            @foreach($active_pumps ?? '' as $pump)
                            <li style="list-style: none"><a href="/user/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <h2>Inactieve pompen</h2>
                    <ul>
                        @foreach($inactive_pumps ?? '' as $pump)
                            <li style="list-style: none"><a href="/user/pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="curve_chart" class="mt-5"></div>
    @endauth
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Stroom'],
                ['2004',  1000],
                ['2005',  1170],
                ['2006',  660],
                ['2007',  1030]
            ]);

            var options = {
                title: 'Company Performance',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>


@endsection
