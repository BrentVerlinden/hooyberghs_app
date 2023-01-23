@extends('layouts.template')

@section('title', 'Werfgebruikers')

@section('main')
    <div class="fixedmt"></div>
    <h1>Werfgebruikers</h1>
{{--    @include('shared.alert')--}}
    <p>
        <a href="/admin/werf/{{ $werf->id }}/users/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe werfgebruiker aan
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="d-none d-md-table-cell">#</th>
                <th>Naam</th>
                <th  class="d-none d-md-table-cell">Email</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="d-none d-md-table-cell">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                    <td >
                        <form action="/admin/werf/{{ $werf->id }}/users/{{ $user->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/werf/{{ $werf->id }}/users/{{ $user->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $user->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->name != auth()->user()->name)
                                    <button type="submit" class="btn btn-outline-danger"
                                            data-toggle="tooltip"
                                            title="Delete {{ $user->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
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
