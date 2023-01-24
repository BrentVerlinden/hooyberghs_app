@extends('layouts.template')

@section('title', 'Pomp bewerken')

@section('main')
    <div class="fixedmt"></div>
    <h1>Pomp bewerken: {{ $pump->pumpnamename }}</h1>
    <form action="/admin/werf/{{$werf->id}}/pumps/{{ $pump->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required
                   value="{{ old('name', $pump->pumpname) }}">

            <label for="location">Locatie</label>
            <input type="text" name="location" id="location"
                   class="form-control @error('location') is-invalid @enderror"
                   placeholder="Locatie"
                   minlength="3"
                   required
                   value="{{ old('location', $pump->location) }}">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Pomp opslaan</button>
    </form>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Terug</a>
@endsection
