@extends('layouts.template')
@section('title', 'Pompen')
@section('main')
    <div class="fixedmt"></div>
    <div class="card-deck d-flex flex-wrap">
        @foreach($pumps as $pump)
            <div class="card mb-3 mx-3" style="min-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pomp: {{$pump->pumpname}}</h5>
                    <p class="card-text">Locatie: {{$pump->location}}</p>
                    @if($pump->error == 1)
                        <p class="mb-5">Er is mogelijk iets mis met de pomp (error). Kijk dit eerst na en zet de pomp aan via detail page om de error te overrulen.</p>
                    @endif
                    @if($pump->automatic == 0 && $pump->error != 1)
                        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/{{$pump->id}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group ">
                                <label for="depth">Diepte (in m)</label>
                                <input type="text" name="depth" id="depth"
                                       class="form-control  @error('depth') is-invalid @enderror"
                                       placeholder="Diepte (bvb 3.5)"
                                       required>
                                @error('depth')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mb-5">Start automatisatie</button>
                        </form>
                    @endif
                    @if($pump->automatic==1 && $pump->error != 1)
                        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/extra/{{$pump->id}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group ">
                            </div>
                            <button type="submit" class="btn btn-danger mb-5">Stop automatisatie</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{--    <div class="card-deck">--}}
{{--        @foreach($pumps as $pump)--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h5 class="card-title">Pomp: {{$pump->pumpname}}</h5>--}}
{{--                    <p class="card-text">Locatie: {{$pump->location}}</p>--}}
{{--                    @if($pump->error == 1)--}}
{{--                        <p class="mb-5">Er is mogelijk iets mis met de pomp (error). Kijk dit eerst na en zet de pomp aan via detail page om de error te overrulen.</p>--}}
{{--                    @endif--}}
{{--                    @if($pump->automatic == 0 && $pump->error != 1)--}}
{{--                        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/{{$pump->id}}" method="post">--}}
{{--                            @method('put')--}}
{{--                            @csrf--}}
{{--                            <div class="form-group ">--}}
{{--                                <label for="depth">Diepte</label>--}}
{{--                                <input type="text" name="depth" id="depth"--}}
{{--                                       class="form-control  @error('depth') is-invalid @enderror"--}}
{{--                                       placeholder="Diepte"--}}
{{--                                       required>--}}
{{--                                @error('depth')--}}
{{--                                <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-success mb-5">Start automatisatie</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                    @if($pump->automatic==1 && $pump->error != 1)--}}
{{--                        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/extra/{{$pump->id}}" method="post">--}}
{{--                            @method('put')--}}
{{--                            @csrf--}}
{{--                            <div class="form-group ">--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-danger mb-5">Stop automatisatie</button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
    {{--    @foreach($pumps as $pump)--}}
{{--        <h2>Pomp: {{$pump->pumpname}}</h2>--}}
{{--        <p>Locatie: {{$pump->location}}</p>--}}
{{--        @if($pump->error == 1)--}}
{{--            <p class="mb-5">Er is mogelijk iets mis met de pomp (error). Kijk dit eerst na en zet de pomp aan via detail page om de error te overrulen.</p>--}}
{{--            @endif--}}
{{--    @if($pump->automatic == 0 && $pump->error != 1)--}}
{{--        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/{{$pump->id}}" method="post">--}}
{{--        @method('put')--}}
{{--        @csrf--}}
{{--        <div class="form-group ">--}}
{{--            <label for="depth">Diepte</label>--}}
{{--            <input type="text" name="depth" id="depth"--}}
{{--                   class="form-control  @error('depth') is-invalid @enderror"--}}
{{--                   placeholder="Diepte"--}}
{{--                   required>--}}
{{--            @error('depth')--}}
{{--            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-success mb-5">Start automatisatie</button>--}}

{{--    </form>--}}
{{--    @endif--}}
{{--    @if($pump->automatic==1 && $pump->error != 1)--}}
{{--        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/extra/{{$pump->id}}" method="post">--}}
{{--            @method('put')--}}
{{--            @csrf--}}
{{--            <div class="form-group ">--}}

{{--            </div>--}}
{{--            <button type="submit" class="btn btn-danger mb-5">Stop automatisatie</button>--}}

{{--        </form>--}}

{{--    @endif--}}
{{--    @endforeach--}}
    <a href="/user/werf/{{$werf->id}}/home" class="btn btn-primary mt-5">Terug</a>

@endsection
