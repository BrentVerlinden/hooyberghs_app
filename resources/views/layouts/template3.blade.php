<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/hooyberghs_logo_one.jpg') }}">
    @yield('css_after')
    <title>@yield('title', 'Hooyberghs Applicatie')</title>
</head>
<body>
{{--  Navigation  --}}
<div id="navtop">
{{--    @include('shared.basicnav')--}}
</div>
<main class="container mt-5 mb-5 pb-5">
    @yield('main', 'Page under construction ...')
</main>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script_after')
</body>
</html>
