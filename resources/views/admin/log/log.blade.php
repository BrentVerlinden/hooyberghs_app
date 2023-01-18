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
                <h2>Alle logs</h2>
                <ul >
                    @foreach($logs ?? '' as $log)
                        <li style="list-style: none"><i class="fa-solid fa-circle-exclamation"></i> Naam: {{ $log->nameLog }}, Beschrijving: {{ $log->description }}, Tijd: {{ $log->date }} </li>
                    @endforeach
                </ul>
                <h2 class="mt-5">Kies hieronder een zoekterm (beschrijving) en filter!</h2>
            <form method="get" action="/admin/filtered" id="searchForm" class="mid">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <input type="text" class="form-control" name="description" id="description"
                               value="" placeholder="Filter description">
                    </div>
                    <div class="col-sm-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Search</button>
                    </div>
                </div>
            </form>
            <hr>

            {{--                <div class="d-flex justify-content-center">--}}
{{--                <form class="form-inline my-2 my-lg-0" href="/admin/filtered">--}}
{{--                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
{{--                </form>--}}
{{--                </div>--}}
{{--                <ul >--}}
{{--                    @foreach($filtlogs ?? '' as $log)--}}
{{--                        <li style="list-style: none"><i class="fa-solid fa-circle-exclamation"></i> Naam: {{ $log->nameLog }}, Beschrijving: {{ $log->description }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
        </div>
    @endauth

@endsection
