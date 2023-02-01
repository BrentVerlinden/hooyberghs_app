{{--@extends('layouts.app')--}}
@extends('layouts.app')

@extends('layouts.template3')

@section('title', 'Login')

@section('main')
{{--    <h1 class="mt-5">Login</h1>--}}
<link rel="shortcut icon" href="{{ asset('img/hooyberghs_logo_one.jpg') }}">
<title>@yield('title', 'Hooyberghs Applicatie')</title>

<?php
$images = array("img/hooyberghs.jpg", "img/hooyberghs2.jpg");
$i = rand(0, count($images)-1);
$selectedImage = $images[$i];
?>

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="<?php echo $selectedImage; ?>" alt="hooyberghs" width="500" height="310" class="testimg">
                        </div>
{{--                        <div class="d-lg-none d-sm-block">--}}
{{--                            <img src="img/hooyberghs_logo_one.jpg" alt="hooyberghs" class="testimg">--}}
{{--                        </div>--}}
{{--                        <div class="text-center d-lg-none d-sm-block">--}}
{{--                            <img src="img/hooyberghs_logo_one.jpg" alt="hooyberghs" class="mx-auto d-block">--}}
{{--                        </div>--}}
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welkom!</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=john@example.com>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="******">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button style="background-color: #1C60AA" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('password.request')}}">Wachtwoord vergeten?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
{{--        <p>admin: badr.azougagh@example.com--}}
{{--            ww: admin1234</p>--}}
{{--        <p><br>User: rutger.stessens@example.com--}}
{{--            ww: user1234</p>--}}

    </div>
@endsection





