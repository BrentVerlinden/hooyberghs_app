@extends('layouts.template')

@section('title', 'Werven')

@section('main')

    <div class="fixedmt"></div>
    <h1>Werven</h1>
{{--        @include('shared.alert')--}}
    <p>
        <a href="/admin/werf/crud/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe werf aan
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
{{--                <th class="d-none d-md-table-cell">#</th>--}}
                <th class="text-center">Naam</th>
                <th class="text-center">Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($werfs as $werf)
                <tr>
{{--                    <td class="">{{ $werf->id }}</td>--}}
                    <td class="text-center">{{ $werf->name }}</td>
                    <td class="text-center">
                        <form action="/admin/werf/crud/{{ $werf->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/werf/crud/{{ $werf->id }}/edit" class="btn btn-outline-success"
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
@endsection

<script>
    var message = "{!! session()->get('success') !!}";
    if (message) {
        alert(message);
    }
</script>
