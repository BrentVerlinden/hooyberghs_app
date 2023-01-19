@extends('layouts.template')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
@section('main')
    <div class="fixedmt"></div>
    <h1 class="pump">{{$pump->pumpname}}</h1>

<p>Status:
    @if($pump->status)
        Active
    @else
        Inactive
    <br>
        @if($pump->motif !== "" &&  $pump->motif !== null)
        <small >Reden: {{ $pump->motif }}</small>
        @else<small >Geen reden gevonden</small>
        @endif
    @endif
</p>



    @if(auth()->user()->admin)
    <form action="{{ $pump->id }}" method="POST">
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
            <input type="checkbox" name="status" id="status" onchange="this.form.submit()" {{ $pump->status ? 'checked' : ''}}>
            <label for="status"></label>
        </div>
    </form>
    @endif

    <div id="curve_chart"></div>
    <div id="chart"></div>

@endsection
<style>


</style>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = @json($power_consumptions);
        var chartData = [['Tijd', 'Stroom']];

        data[0].power.forEach(function(power) {
            chartData.push([power.time, power.power]);
        });
        var options = {
            title: 'Stroomverbruik kwh',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        // Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);

        // Create and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart'));
        chart.draw(chartDataTable,options);
    }

</script>

