@extends('layouts.template')

@section('title', 'Nieuwe werf aanmaken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Nieuwe werf aanmaken.</h1>
    <form action="/admin/werf/crud" method="post">
        @include('werf.form')
    </form>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Terug</a>
@endsection


