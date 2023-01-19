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
            <h2>Filtered logs (op basis van uw zoekopdracht)</h2>
            <ul >
                @foreach($logs ?? '' as $log)
                    <li style="list-style: none"><i class="fa-solid fa-circle-exclamation"></i> Naam: {{ $log->nameLog }}, Beschrijving: {{ $log->description }}, Tijd: {{ $log->date }}</li>
                @endforeach
            </ul>
        </div>
    @endauth

@endsection
