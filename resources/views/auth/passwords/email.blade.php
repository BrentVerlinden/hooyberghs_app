@extends('layouts.app')

@extends('layouts.template3')

@section('title', 'Wachtwoord vergeten')

@section('main')

<link rel="shortcut icon" href="{{ asset('img/hooyberghs_logo_one.jpg') }}">
<title>@yield('title', 'Hooyberghs Applicatie')</title>

<?php
$images = array("../img/hooyberghs.jpg", "../img/hooyberghs2.jpg");
$i = rand(0, count($images)-1);
$selectedImage = $images[$i];
?>

<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none p-0 d-lg-block"><img src="<?php echo $selectedImage; ?>" alt="hooyberghs" width="500" height="270" class="testimg"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Wachtwoord vergeten</h1>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=john@example.com>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                {{--                                    <div class="form-group row mb-0">--}}
                                {{--                                        <div class="col-md-6 offset-md-4">--}}
                                {{--                                            <button type="submit" class="btn btn-primary">--}}
                                {{--                                                {{ __('Verstuur wachtwoord reset link') }}--}}
                                {{--                                            </button>--}}

                                {{--                                        </div>--}}
                                {{--                                    </div>--}}

                                <button class="btn btn-primary btn-user btn-block">
                                    Verstuur wachtwoord reset link
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="/">Terug</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
