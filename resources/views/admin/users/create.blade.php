@extends('layouts.template')

@section('title', 'Nieuwe gebruiker aanmaken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Nieuwe gebruiker aanmaken.</h1>
    <form action="/admin/users" method="post">
        @include('admin.users.form')
    </form>
@endsection
