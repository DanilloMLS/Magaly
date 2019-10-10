<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Magaly</title>
        <link rel="shortcut icon" href="/img/MG-S.png" type="image/x-png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <img class=" logo-garanhuns top-left" src="/img/logo.png">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}"><img width="70%" class="btn-img" align="center" src="/img/login.png"></a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <h1 class="title-body-text">Magaly</h1>
                </div>
            </div>
        </div>
    </body>
</html>
