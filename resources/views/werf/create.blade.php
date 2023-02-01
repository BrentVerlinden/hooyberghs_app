@extends('layouts.template2')

@section('title', 'Nieuwe werf aanmaken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Werf aanmaken</h1>
    <form action="/admin/werf/crud" method="post">
        @include('werf.form')
    </form>

    <a href="{{ url()->previous() }}" style="background-color: #1C60AA" class="btn btn-primary mt-3">Terug</a>
@endsection


