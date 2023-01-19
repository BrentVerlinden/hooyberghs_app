@extends('layouts.template')

@section('title', 'Gebruiker bewerken')

@section('main')
    <h1>Gebruiker bewerken: {{ $user->name }}</h1>
    <form action="/admin/users/{{ $user->id }}" method="post">
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

            <label for="admin">Admin</label>
            <br>
            <input type="hidden" name="admin" value="0">
            <input type="checkbox" name="admin" value="1" {{ $user->admin ? 'checked' : '' }}>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Gebruiker opslaan</button>
    </form>
@endsection
