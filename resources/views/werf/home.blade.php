@extends('layouts.template')

@section('main')
    <div class="fixedmt"></div>
    @if(auth()->user()->admin)
    <h1>Werven</h1>
    <a href="/admin/werf/crud" class="btn btn-primary mt-3">Alle werven beheren</a>
    @endif
    <h1 class="mt-4">Jouw werven</h1>
    <p>U bent ingelogd als  {{ auth()->user()->name }}!</p>
    <br>
    @guest
        <p>Please login...</p>
    @endguest
    @auth
        <div class="container">

            <div class="row">
                @foreach($werfs ?? '' as $werf)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card mb-4 card-size">
                            <div class="card-body">
                                <a href="/user/werf/{id}"><h5 class="card-title">{{ $werf->name }}</h5></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endauth

@endsection
