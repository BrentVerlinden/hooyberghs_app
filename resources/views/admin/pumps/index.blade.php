@extends('layouts.template')

@section('title', 'Pompen')

@section('main')
    <div class="fixedmt"></div>
    <h1>Pompen</h1>
    {{--    @include('shared.alert')--}}
    <p>
        <a href="/admin/users/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe pomp aan
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="d-none d-md-table-cell">#</th>
                <th>Naam</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pumps as $pump)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $pump->id }}</td>
                    <td>{{ $pump->pumpname }}</td>
                    <td >
                        <form action="/admin/users/{{ $pump->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/users/{{ $pump->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $pump->pumpname }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                    <button type="submit" class="btn btn-outline-danger"
                                            data-toggle="tooltip"
                                            title="Delete {{ $pump->pumpname }}">
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
