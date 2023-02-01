@extends('layouts.template')

@section('title', 'Nieuwe pomp aanmaken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Nieuwe pomp aanmaken</h1>
    <form action="/admin/werf/{{$werf->id}}/pumps" method="post">
        @include('admin.pumps.form')
    </form>

    <a href="/admin/werf/{{$werf->id}}/pumps" style="background-color: #1C60AA" class="btn btn-primary mt-3">Terug</a>
@endsection


