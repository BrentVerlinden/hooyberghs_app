@extends('layouts.template')

@section('title', 'Detail pomp')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="{{ asset('css/showpump.css') }}" rel="stylesheet">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('/img/hooyberghs_logo_one.jpg') }}">
</head>
@section('main')

    <div>


        <div class="fixedmt"></div>
        <h1 class="pump">{{$pump->pumpname}}</h1>

        @if($werf->frequention == 1)
            {{--            && $pump->error != 1--}}
            <p>Frequentiegestuurde pomp</p>

          <p>Frequentie: <span  id="rangeValue"> {{$pump->percentage}} </span> </p>


            <p>
                @if($pump->percentage > 0)
                    @if(!$pump->error)
                    <span class="logged-in">● </span>Actief
                    @endif
                @else
                    @if(!$pump->error)
                    <span class="logged-out">● </span>Inactief
                    <br>
                    @endif
                @endif
            </p>

            @if(auth()->user()->admin && $pump->automatic == 0)
                <form>
                    @csrf
                    <div>

                        <Input  class="slider"  type="range" value="{{ old('percentage', $pump->percentage) }}" min="0" max="100" onChange="rangeSlide(this.value)" id="range-slider" onmousemove="rangeSlide(this.value)"></Input>
                    </div>

                </form>
            @endif
        @endif

        @if($werf->frequention == 0)
            <p>
                @if($pump->status)
                    @if(!$pump->error)
                    <span class="logged-in">● </span>Actief
                    @endif
                @else
                    @if(!$pump->error)
                    <span class="logged-out">● </span>Inactief
                    <br>
                    @endif
                @endif
            </p>

            @if(auth()->user()->admin && $pump->automatic == 0)
                <form action="/admin/werf/{{ $werf->id }}/pump/{{ $pump->id }}" method="POST">
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
        @endif

        @if($pump->error == 1)
            <p><span class="errorr">● </span>Error</p>
                    @if($pump->motif !== "" &&  $pump->motif !== null)
                        <small>Reden: {{ $pump->motif }}</small>
                    @else<small>Geen reden gevonden</small>
                    @endif
            <br>
            <small class="mt-2">(Om de pomp error manueel te overschrijven moet je de pomp terug inschakelen)</small>
        @endif

        <div class="mt-5">

            <div id="dashboard_div">

                <div class="mb-5"><h3>Waterniveau </h3>
                    <div class="border ">
                        <div id="filter4"></div>

                        <div id="chart4"></div>
                    </div>
                </div>

                <div class="mb-5"><h3>Stroom </h3>
                    <div class="border ">
                        <div id="filter3"></div>

                        <div id="chart3"></div>
                    </div>
                </div>
                <div class="mb-5"><h3>Waterdebiet</h3>
                    <div class=" border">
                        <div id="filter2"></div>
                        <div id="chart2"></div>
                    </div>
                </div>
{{--                <div class="mb-5"><h3>Verbruik KWH</h3>--}}
{{--                    <div class="border ">--}}
{{--                        <div id="filter_div"></div>--}}

{{--                        <div id="chart_div"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}


            </div>
        </div>


    </div>

    <a href="/user/werf/{{$werf->id}}/home" class="btn btn-primary mt-3">Terug</a>

@endsection

naam:data[0]['pumpname']
power:data[0]['powerconsumption'][0]['power'][0]['power']
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart', 'controls']});

    // google.charts.setOnLoadCallback(drawChart1);//verbruik KWH
    google.charts.setOnLoadCallback(drawChart2);//Waterdebiet m3/S
    google.charts.setOnLoadCallback(drawChart3);//Stroom ampere
    google.charts.setOnLoadCallback(drawChart4);//Waterniveau
    function drawChart1() {
        var data = @json($power_consumptions);
        var chartData = [['Datum', 'Verbruik']];

        data.forEach(function (usage) {

            chartData.push([new Date(usage.created_at), usage.usage]);

        });

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
                title: 'Verbruik kwh',
                curveType: 'function',
                legend: {position: 'right'},
                hAxis: {
                    format: "MMM d, yyyy HH:mm"
                },
                vAxis: {
                    title: 'Verbruik'
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

        data.forEach(function (flowrate) {
           // console.log(flowrate);
           chartData.push([new Date(flowrate.created_at), flowrate.flowrate]);
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

    function drawChart3() {
        var data = @json($power_consumptions);
        var chartData = [['Datum', 'Stroom']];

        data.forEach(function (stroom) {
            chartData.push([new Date(stroom.created_at), stroom.current]);

        });
        console.log('chart3', data[0].stroom);

// Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create a dashboard
        var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

        // Create the date range filter
        var dateRangeFilter = new google.visualization.ControlWrapper({
            'controlType': 'DateRangeFilter',
            'containerId': 'filter3',
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
            'containerId': 'chart3',
            'options': {
                title: 'Stroom Ampère',
                curveType: 'function',
                legend: {position: 'right'},
                hAxis: {
                    format: "MMM d, yyyy HH:mm"
                },
                vAxis: {
                    title: 'Stroom'
                },
                series: {
                    0: {color: 'black'}
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

    function drawChart4() {
        var data = @json($pump);
        var chartData = [['Datum', 'Waterniveau']];
console.log();
        data.sensor.sensordatas.forEach(function (sensor) {
            chartData.push([new Date(sensor.created_at), sensor.water_level]);

        });
        console.log('chart4', );

// Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create a dashboard
        var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

        // Create the date range filter
        var dateRangeFilter = new google.visualization.ControlWrapper({
            'controlType': 'DateRangeFilter',
            'containerId': 'filter4',
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
            'containerId': 'chart4',
            'options': {
                title: 'Waterniveau',
                curveType: 'function',
                legend: {position: 'right'},
                hAxis: {
                    format: "MMM d, yyyy HH:mm"
                },
                vAxis: {
                    title: 'Meter'
                },
                series: {
                    0: {color: 'black'}
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

    function rangeSlide(value) {
        document.getElementById('rangeValue').innerHTML = value;
    }

    $(document).ready(function() {
        $("#range-slider").on("input", function() {
            var sliderValue = $(this).val();
            // send an AJAX request to the server with the new value
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/admin/werf/{{ $werf->id }}/pump/{{ $pump->id }}/handle-value-change",
                data: {range_slider: sliderValue},
                success: function (data) {
                    // handle the response from the server
                    $("#percentage").text(sliderValue);
                    window.location.reload();
                }
            });
        });
    });


</script>

<style>

    .range {
        width: 400px;
        height: 15px;
        -webkit-appearance: none;
        background: #111;
        outline: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 1);
    }

    .range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #00fd0a;
        cursor: pointer;
        border: 4px solid #333;
        box-shadow: -407px 0 0 400px #00fd0a;
    }

</style>
