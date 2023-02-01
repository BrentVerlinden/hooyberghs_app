@extends('layouts.template')

@section('title', 'Nieuwe gebruiker aanmaken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Nieuwe werfgebruiker aanmaken.</h1>
    <form action="/admin/werf/{{ $werf->id }}/users" method="post">
        @include('admin.users.form')
    </form>

    <a href="{{ url()->previous() }}" style="background-color: #1C60AA" class="btn btn-primary mt-3">Terug</a>
@endsection


