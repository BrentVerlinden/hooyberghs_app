@extends('layouts.template2')

@section('title', 'Werven')

@section('main')

    <div class="fixedmt"></div>
    @include('shared.alert')
    <h1>Werven</h1>
{{--        @include('shared.alert')--}}
    <p>
        <a href="/admin/werf/crud/create" class="btn edit-button btn-outline-success">
            <i class="fas fa-plus-circle mr-1 "></i>Maak een nieuwe werf aan
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
{{--                <th class="d-none d-md-table-cell">#</th>--}}
                <th class="">Naam</th>
                <th class="d-none d-md-table-cell text-center " style="vertical-align: middle;">Soort pompen</th>
                <th class="text-right">Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($werfs as $werf)
                <tr>
{{--                    <td class="">{{ $werf->id }}</td>--}}
                    <td class="">{{ $werf->name }}</td>
                    <td class="d-none d-md-table-cell text-center" style="vertical-align: middle;">
                        @if($werf->frequention == 1)
                            Frequentiegestuurd
                        @else
                            Binair
                        @endif
                    </td>
                    <td class="text-right">
                        <form action="/admin/werf/crud/{{ $werf->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/werf/crud/{{ $werf->id }}/edit"  class="edit-button btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $werf->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete {{ $werf->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <a href="/" class="btn btn-primary mt-3">Terug</a>
@endsection


