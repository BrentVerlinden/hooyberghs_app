@extends('layouts.template')
@section('title', 'Pompen')
@section('main')
    <div class="fixedmt"></div>
    <form action="/admin/pumpsettings" method="post">
        @csrf
        <div class="form-group ">
            <label for="depth">Diepte</label>
            <input type="text" name="depth" id="depth"
                   class="form-control  @error('depth') is-invalid @enderror"
                   placeholder="Diepte"
                   required>


            <label for="day">Aantal dagen</label>
            <input type="text" name="day" id="day"
                   class="form-control @error('dag') is-invalid @enderror"
                   placeholder="Dag"
                   required>


            @error('depth')



            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Start met pompen</button>

    </form>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Terug</a>

@endsection
