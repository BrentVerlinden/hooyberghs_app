@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifieer je email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Er is een nieuwe verificatielink naar je email gestuurd.') }}
                        </div>
                    @endif

                    {{ __('Check alsjeblieft je email voordat je verder gaat.') }}
                    {{ __('Als je geen email ontvangen hebt') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik hier om een andere te versturen') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
