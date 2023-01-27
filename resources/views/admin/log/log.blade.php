@extends('layouts.template')

@section('title', 'Logboek')

@section('main')
    <div class="fixedmt"></div>
    <h1>Logboek</h1>
    <p>U bent ingelogd als  {{ auth()->user()->name }}!</p>
    <br>
    @guest
        <p>Please login...</p>
    @endguest
    @auth
        <div class="text-center align-content-center">
            <div class="container d-flex justify-content-center">
                <form method="get" action="/admin/werf/{{$werf->id}}/log" id="searchForm" class="mx-auto">
                    <div class="row">
                        <div class="mr-2">
                            <input type="text" class="form-control" name="description" id="description"
                                   value="" placeholder="Filter beschrijving">
                        </div>
                        <div class="form-group mr-lg-2 mt-lg-0 mt-sm-2 mt-md-0">

                            <input type="date" class="form-control" name="date" id="date" value="{{ request()->input('date') }}">
                        </div>
                        <div class="mt-sm-2 mt-lg-0 mt-md-0">
                            <button type="submit" class="btn btn-success btn-block">Zoeken</button>
                        </div>

                    </div>
                </form>
            </div>
            <hr>
        </div>
        {{ $logs->withQueryString()->links() }}
        <div class="table-responsive text-left">
            <table class="table">
                <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Naam</th>
                    <th>Beschrijving</th>
                    <th>Tijd</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        {{--                    <td class="d-none d-md-table-cell">{{ $user->id }}</td>--}}
                        <td class="d-none d-md-table-cell">{{ $log->nameLog }}</td>
                        <td class="">{{ $log->description }}</td>
                        <td>{{ date("d/m/Y H:i:s", strtotime($log->date)) }}</td>
                    </tr>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $logs->withQueryString()->links() }}
        </div>
    @endauth

@endsection

{{--<script>--}}
{{--    window.onload = function() {--}}
{{--        @foreach($logs ?? '' as $log)--}}
{{--        toggleDescription({{$loop->index}});--}}
{{--        @endforeach--}}
{{--    }--}}

{{--    function toggleDescription(index) {--}}
{{--        var description = document.getElementById("description" + index);--}}
{{--        if (description.style.display === "none") {--}}
{{--            description.style.display = "block";--}}
{{--        } else {--}}
{{--            description.style.display = "none";--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}

<script>
    function toggleColumn(columnClass) {
        var column = document.getElementsByClassName(columnClass);
        for (var i = 0; i < column.length; i++) {
            if (column[i].style.display === "none") {
                column[i].style.display = "table-cell";
            } else {
                column[i].style.display = "none";
            }
        }
    }
</script>
