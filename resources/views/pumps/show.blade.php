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
                <span class="logged-in">●</span> Actief
            @else
                <span class="logged-out">●</span>  Inactief
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
        <div class="mt-5">

            <div id="dashboard_div">
                <div class="border pt-4">
                <div id="filter_div"></div>

                <div id="chart_div"></div></div>
<div class="mt-5 border pt-4">
    <div id="filter2"></div>
                <div id="chart2"></div>
               </div>
            </div>
        </div>


    </div>

@endsection

naam:data[0]['pumpname']
power:data[0]['powerconsumption'][0]['power'][0]['power']
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart', 'controls']});

    google.charts.setOnLoadCallback(drawChart1);
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart1() {
        var data = @json($power_consumptions);
        var chartData = [['Datum', 'Stroom']];
console.log(data[1]);
        data[0].power.forEach(function (power) {
            chartData.push([new Date(power.time), power.power]);

        });
   console.log(data);

// Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create a dashboard
        var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

        // Create the date range filter
        var dateRangeFilter = new google.visualization.ControlWrapper({
            'controlType': 'DateRangeFilter',
            'containerId': 'filter_div',
            'options': {
                'filterColumnLabel': 'Datum',
                'ui': {
                    'format': {
                        'pattern': 'dd-MM-yyyy'
                    }
                }
            }
        });


        // Create the chart
        var chart = new google.visualization.ChartWrapper({
            'chartType': 'LineChart',
            'containerId': 'chart_div',
            'options': {
                title: 'Stroomverbruik kwh',
                curveType: 'function',
                legend: {position: 'right'},
                hAxis: {
                    format: "MMM d, yyyy HH:mm"
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
            }
        });

        // Create the default view
        var defaultView = new google.visualization.DataView(chartDataTable);

        // Bind the data table to the date range filter
        dateRangeFilter.setDataTable(defaultView);

        // Listen for the 'statechange' event

        // Draw the dashboard
        dashboard.bind(dateRangeFilter, chart);
        dashboard.draw(defaultView);
    }


    function drawChart2() {
        var data = @json($flowrates);
        var chartData = [['Datum', 'Debiet']];

        data[0].flowrate.forEach(function (flowrate) {
            chartData.push([new Date(flowrate.time), flowrate.flowrate]);
        });


// Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create a dashboard
        var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

        // Create the date range filter
        var dateRangeFilter = new google.visualization.ControlWrapper({
            'controlType': 'DateRangeFilter',
            'containerId': 'filter2',
            'options': {
                'filterColumnLabel': 'Datum',
                'ui': {
                    'format': {
                        'pattern': 'dd-MM-yyyy'
                    }
                }
            }
        });


        // Create the chart
        var chart = new google.visualization.ChartWrapper({
            'chartType': 'LineChart',
            'containerId': 'chart2',
            'options': {
                title: 'Waterdebiet in kubieke m/s',
                curveType: 'function',
                legend: {position: 'right'},
                hAxis: {
                    format: "MMM d, yyyy HH:mm"
                },
                vAxis: {
                    title: 'm3/s'
                },
                series: {
                    0: {color: '#096192'}
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
            }
        });

        // Create the default view
        var defaultView = new google.visualization.DataView(chartDataTable);

        // Bind the data table to the date range filter
        dateRangeFilter.setDataTable(defaultView);

        // Listen for the 'statechange' event

        // Draw the dashboard
        dashboard.bind(dateRangeFilter, chart);
        dashboard.draw(defaultView);
    }

</script>

