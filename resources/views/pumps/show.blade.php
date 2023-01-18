@extends('layouts.template')
<head><script src="https://www.gstatic.com/charts/loader.js"></script></head>

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
        <label for="status"> @if($pump->status)
                Pomp uitschakelen?
            @else
                Pomp inschakelen?
            @endif</label>
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
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-switch input[type="checkbox"] {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-switch label {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .toggle-switch label:before {
        position: absolute;
        content: "";
        height: 24px;
        width: 24px;
        left: 1px;
        bottom: 1px;

        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input[type="checkbox"]:checked + label {
        background-color: #3e8e41;
    }

    input[type="checkbox"]:focus + label {
        box-shadow: 0 0 1px #3e8e41;
    }

    input[type="checkbox"]:checked + label:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .toggle-switch.round label {
        border-radius: 34px;
    }

    .toggle-switch.round label:before {
        border-radius: 50%;
    }
</style>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = @json($power_consumptions);
        console.log();
        var chartData = [['Tijd', 'Stroom']];

        data[0].power.forEach(function(power) {
            console.log(power.power)
            chartData.push([power.time, power.power]);
        });
        var options = {
            title: 'Stroomverbruik kwh',
            curveType: 'function',
            legend: { position: 'bottom' }
        };


        // // Create the data table
        var chartDataTable = new google.visualization.arrayToDataTable(chartData);
        //
        // // Create and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('chart'));
        chart.draw(chartDataTable,options);
    }

</script>

