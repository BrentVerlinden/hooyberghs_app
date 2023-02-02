@extends('layouts.template')
@section('title', 'Pompen')
@section('main')
    <div class="fixedmt"></div>
    @if(count($pumps)>0)
        @include('shared.alert')
    <div class="card-deck d-flex flex-wrap ">
        @foreach($pumps as $pump)
            <div class="card mb-3 mx-3 l-bg-gray" style="min-width: 18rem;">
                <div class="card-body">
                    <a href="/user/werf/{{ $werf->id }}/pump/{{ $pump->id }}">  <h5 class="card-title"> {{$pump->pumpname}}</h5></a>
                    <h6>{{$pump->sensor->name}}</h6>
                    <p class="card-text">Locatie: {{$pump->location}}</p>
                    @if($pump->error == 1)
                        <p class="mb-5">Foutmelding bij de pomp. Schakel deze handmatig in om de error te resetten.</p>
                        <form action="/admin/werf/{{$werf->id}}/pumpsettings/{{$pump->id}}/reset" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger mb-5">Reset pomp</button>
                        </form>
                    @endif
                    @if(isset($pump->sensor->sensordatas->last()->water_level) != null)
                        @if($pump->error != 1)
                        <p>Huidig waterniveau: {{$pump->sensor->sensordatas->last()->water_level}}</p>
                        @endif
                    @endif
                    @if($pump->automatic == 0 && $pump->error != 1)
                        @if(isset($pump->sensor->sensordatas->last()->water_level) != null)
                        <form action="/admin/werf/{{ $werf->id }}/pumpsettings/{{$pump->id}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group ">
{{--                                <label for="depth"></label>--}}
                                <input type="text" name="depth" id="depth"
                                       class="form-control  @error('depth') is-invalid @enderror"
                                       placeholder="Gewenst niveau (bvb 3.5)"

                                       required>
                                @error('depth')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" style="background-color:#4D9B24" class="btn btn-success mb-5 ">Start automatisatie</button>
                        </form>
                        @else
                            <p>Er is geen data voor deze pomp.</p>
                    @endif
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

    @else
        <h1>Automatisatie</h1>
        <p>Geen pompen gevonden</p>
    @endif
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
    <a href="/user/werf/{{$werf->id}}/home" style="background-color: #1C60AA"  class="btn btn-primary mt-5">Terug</a>

@endsection
