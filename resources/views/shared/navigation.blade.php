
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/user/werf/{{$werf->id}}/home">
            <img src="{{ asset('img/hooyberghs_logo_two.png') }}" alt="hooyberghs logo" class="img-fluid" height="59" width="329"
            id="img-1">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Login</a>
                    </li>

                @endguest
                    @auth

                <li class="nav-item dropdown ml-4">
{{--                    <p class="text-center mt-2">Werf: </p>--}}
                    <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                        <i class="fas fa-user"></i>     {{ auth()->user()->name }} ({{$werf->name}}) <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        @if(auth()->user()->admin)
                            <form action="/admin/werf/{{$werf->id}}/pumps" method="get">
                                @csrf
                                <button type="submit" class="dropdown-item"> Pompen beheren
                                </button>
                            </form>


                            <form action="/admin/werf/{{ $werf->id }}/pumpsettings" method="get">
                                @csrf
                                <button type="submit" class="dropdown-item"> Automatisatie
                                </button>
                            </form>

                        <form action="/admin/werf/{{$werf->id}}/log" method="get">
                            @csrf
                            <button type="submit" class="dropdown-item"> Logboek
                            </button>
                        </form>
                        @endif

                            @if(auth()->user()->admin)
                                <hr>
                                <form action="/admin/werf/{{$werf->id}}/users" method="get">
                                    @csrf
                                    <button type="submit" class="dropdown-item"> Gebruikers beheren
                                    </button>
                                </form>
                            @endif
                            <form action="/" method="get">
                                @csrf
                                <button type="submit" class="dropdown-item"> Mijn werven
                                </button>
                            </form>

                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Uitloggen
                            </button>
                        </form>
                    </div>

                </li>  @endauth
            </ul>
        </div>

    </div>
</nav>

