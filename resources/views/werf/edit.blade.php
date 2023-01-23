@extends('layouts.template')

@section('title', 'Werf bewerken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Werf bewerken: {{ $werf->name }}</h1>
    <form action="/admin/werf/crud/{{ $werf->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="1"
                   required
                   value="{{ old('name', $werf->name) }}">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Werf opslaan</button>
    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Terug</a>
@endsection
