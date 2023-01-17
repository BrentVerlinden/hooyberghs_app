@guest
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/hooyberghs_logo_two.png') }}" alt="description of myimage" height="47" width="261">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
{{--                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                            <form action="/logout" method="post">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Uitloggen--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            <i class="fas fa-user"></i>  Admin
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Uitloggen
                                </button>
                            </form>
                        </div>
                    </li>
            </ul>
        </div>

    </div>
</nav>
@endguest
