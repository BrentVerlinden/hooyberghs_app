@extends('layouts.template')

@section('main')
    <div class="fixedmt"></div>
    <h1>Logboek</h1>
    <p>U bent ingelogd als  {{ auth()->user()->name }}!</p>
    <br>
    @guest
        <p>Please login...</p>
    @endguest
    @auth
        <div class="text-center align-content-center">
            {{--                <h2>Alle logs</h2>--}}
            {{--                <ul >--}}
            {{--                    @foreach($logs ?? '' as $log)--}}
            {{--                        <li style="list-style: none"><i class="fa-solid fa-circle-exclamation"></i> Beschrijving: {{ $log->description }}, Tijd: {{ $log->date }} </li>--}}
            {{--                    @endforeach--}}
            {{--                </ul>--}}
            {{--                <h2 class="mt-5">Kies hieronder een zoekterm (beschrijving) en filter!</h2>--}}
            <div class="container d-flex justify-content-center">
                <form method="get" action="/admin/log" id="searchForm" class="mx-auto">
                    <div class="row">
                        <div class="mr-2">
                            <input type="text" class="form-control" name="description" id="description"

                           

                                   value="" placeholder="Filter beschrijving">

                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-success btn-block">Zoeken</button>
                        </div>

                    </div>
                    <div class="form-group mt-2">

                        <input type="date" class="form-control" name="date" id="date" value="{{ request()->input('date') }}">
                    </div>
                </form>
            </div>
            <hr>
        </div>
        <div class="container">

            <div class="row">
                @foreach($logs ?? '' as $log)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card mb-4 card-size">
                            <div class="card-body">
                                <h5 class="card-title">{{ $loop->index + 1 }} - {{ $log->description }}</h5>
                                <p class="card-text">Tijd: {{ $log->date }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--        <div class="container">--}}
{{--            <h2 class="text-center">Alle Logs</h2>--}}
{{--            <div class="row">--}}
{{--                @foreach($logs ?? '' as $log)--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="card mb-4 card-size">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title">{{ $loop->index + 1 }} - {{ $log->description }}</h5>--}}
{{--                                <p class="card-text">Tijd: {{ $log->date }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
    @endauth

@endsection
