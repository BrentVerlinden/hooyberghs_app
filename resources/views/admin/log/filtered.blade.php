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
        <div class="container">
            <h2 class="text-center">Gefilterde Logs</h2>
            <div class="row">
                @foreach($logs ?? '' as $log)
                    <div class="col-md-4">
                        <div class="card mb-4 card-size">
                            <div class="card-body">
                                <h5 class="card-title">{{ $loop->index + 1 }} - Beschrijving: {{ $log->description }}</h5>
                                <p class="card-text">Tijd: {{ $log->date }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--        <div class="text-center align-content-center">--}}
{{--            <h2>Filtered logs (op basis van uw zoekopdracht)</h2>--}}
{{--            <ul >--}}
{{--                @foreach($logs ?? '' as $log)--}}
{{--                    <li style="list-style: none"><i class="fa-solid fa-circle-exclamation"></i> Beschrijving: {{ $log->description }}, Tijd: {{ $log->date }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
        <a href="{{ url()->previous() }}" class="btn btn-primary">Terug</a>
    @endauth

@endsection
