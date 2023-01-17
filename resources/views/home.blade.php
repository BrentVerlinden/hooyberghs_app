@extends('layouts.template')

@section('main')
    <div class="fixedmt"></div>
    <h1>Welkom  {{ auth()->user()->name }}!</h1>
    <br>
    @guest
        <p>Please login...</p>
    @endguest
        @auth
            <div class="row">
                <div class="col-6">
                    <h2>Actieve pompen</h2>
                    <ul>
            @foreach($active_pumps ?? '' as $pump)
                            <li><a href="pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <h2>Inactieve pompen</h2>
                    <ul>
                        @foreach($inactive_pumps ?? '' as $pump)
                            <li><a href="pump/{{ $pump->id }}">{{ $pump->pumpname }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
    @endauth

@endsection
