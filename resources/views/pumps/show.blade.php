@extends('layouts.template')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="{{ asset('css/showpump.css') }}" rel="stylesheet">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
@section('main')
    <div>
        <div class="fixedmt"></div>
        <h1 class="pump">{{$pump->pumpname}}</h1>

        <p>Status:
            @if($pump->status)
                Actief
            @else
                Inactief
                <br>
                @if($pump->motif !== "" &&  $pump->motif !== null)
                    <small>Reden: {{ $pump->motif }}</small>
                @else<small>Geen reden gevonden</small>
                @endif
            @endif
        </p>


        @if(auth()->user()->admin)
            <form action="/admin/pump/{{ $pump->id }}" method="POST">
                @csrf
                @method('PATCH')
                <label for="status">
                    @if($pump->status)
                        Pomp uitschakelen?
                    @else
                        Pomp inschakelen?
                    @endif
                </label>
                <div class="toggle-switch round">
                    <input type="checkbox" name="status" id="status"
                           onchange="this.form.submit()" {{ $pump->status ? 'checked' : ''}}>
                    <label for="status"></label>
                </div>
            </form>
        @endif
        <div>
            <div>
                @if($pump->status)
                    <div class="status-message">Meting is aan het uitvoeren...</div>

                @else
                    <div class="status-message"> Meting is gestopt</div>

                @endif
            </div>
            <div id="dashboard_div">
                <div id="filter_div"></div>
                <div id="chart_div"></div>
                <div id="filter2"></div>
                <div id="chart2"></div>

            </div>
        </div>


    </div>

@endsection


<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart', 'controls']});

    google.charts.setOnLoadCallback(drawChart1);
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart1() {
        var data = @json($power_consumptions);
        var chartData = [['Tijd', 'Stroom']];

        data[0].power.forEach(function (power) {
            chartData.push([power.time, power.power]);
        });
        var options = {
            title: 'Stroomverbruik kwh',
            curveType: 'function',
            legend: {position: 'right'},
            hAxis: {
                title: 'Tijd'
            },
            vAxis: {
                title: 'Stroom'
            },
            series: {
                0: {color: '#D10000'}
            },
            interpolateNulls: true,
            animation: {
                duration: 1000,
                easing: 'out',
            },
            pointSize: 5,
            pointShape: 'circle',

            explorer: {
                axis: 'horizontal',
                keepInBounds: true,
                maxZoomIn: 4.0
            },
        };

        // Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(chartDataTable,options);
    }

    function drawChart2() {
        var data = @json($power_consumptions);
        var chartData = [['Tijd', 'Debiet']];
        data[0].power.forEach(function(power) {
            chartData.push([power.time, power.power]);
        });
        var options = {
            title: 'Waterdebiet in kubieke m/s',
            curveType: 'function',
            legend: { position: 'right' },
            hAxis: {
                title: 'Tijd'
            },
            vAxis: {
                title: 'Debiet'
            }, series: {
                0: { color: '#096192' }
            },
            interpolateNulls: true,
            animation: {
                duration: 1000,
                easing: 'out',
            },
            pointSize: 5,
            pointShape: 'circle',
            crosshair: {
                trigger: 'both',
                color: 'gray',
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true,
                maxZoomIn: 4.0,
                zoomDelta: 0.5,
                zoomEnabled: true,
                actions: ['dragToZoom', 'rightClickToReset'],
            },



        };

        // Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart2'));
        chart.draw(chartDataTable,options);
    }

</script>

