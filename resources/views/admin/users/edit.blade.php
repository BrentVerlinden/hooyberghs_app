@extends('layouts.template')

@section('title', 'Werfgebruiker bewerken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Werfgebruiker bewerken: {{ $user->name }}</h1>
    <form action="/admin/werf/{{ $werf->id }}/users/{{ $user->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required
                   value="{{ old('name', $user->name) }}">

            <label for="email">Email</label>
            <input type="text" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="jan@example.com"
                   minlength="3"
                   required
                   value="{{ old('email', $user->email) }}">
            @if($user->name != auth()->user()->name)
            <label for="admin">Admin</label>
            <br>
            <input type="hidden" name="admin" value="0">
            <input type="checkbox" name="admin" value="1" {{ $user->admin ? 'checked' : '' }}>
            @endif
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" style="background-color:#4D9B24" class="btn btn-success">Gebruiker opslaan</button>
    </form>
    <a href="{{ url()->previous() }}" style="background-color: #1C60AA" class="btn btn-primary mt-3">Terug</a>
@endsection
