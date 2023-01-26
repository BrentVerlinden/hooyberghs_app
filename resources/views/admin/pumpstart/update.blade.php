@extends('layouts.template')
@section('title', 'Pompen')
@section('main')
    <div class="fixedmt"></div>
    @foreach($pumps as $pump)
        <h2>Pump: {{$pump->pumpname}}</h2>
        <p>Location: {{$pump->location}}</p>
    @if($pump->automatic == 0 && $pump->error != 1)
        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/{{$pump->id}}" method="post">
        @method('put')
        @csrf
        <div class="form-group ">
            <label for="depth">Diepte</label>
            <input type="text" name="depth" id="depth"
                   class="form-control  @error('depth') is-invalid @enderror"
                   placeholder="Diepte"
                   required>
            @error('depth')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mb-5">Start met pompen</button>

    </form>
    @endif
    @if($pump->automatic==1)
        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/extra/{{$pump->id}}" method="post">
            @method('put')
            @csrf
            <div class="form-group ">

            </div>
            <button type="submit" class="btn btn-warning">Stop met pompen</button>

        </form>

    @endif
    @endforeach
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Terug</a>

@endsection
