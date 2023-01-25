@extends('layouts.app')

@extends('layouts.template3')

@section('title', 'Wachtwoord resetten')

@extends('layouts.app')

<link rel="shortcut icon" href="{{ asset('img/hooyberghs_logo_one.jpg') }}">
<title>@yield('title', 'Hooyberghs Applicatie')</title>

@section('main')

<?php
$images = array("../../img/hooyberghs.jpg", "../../img/hooyberghs2.jpg");
$i = rand(0, count($images)-1);
$selectedImage = $images[$i];
?>

<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none p-0 d-lg-block"><img src="<?php echo $selectedImage; ?>" alt="hooyberghs" width="500" height="350" class="testimg"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Wachtwoord resetten</h1>
                            </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Wachtwoord') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Herhaal wachtwoord') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Wachtwoord resetten') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div></div>
            </div>
        </div>
    </div>
</div>
@endsection
