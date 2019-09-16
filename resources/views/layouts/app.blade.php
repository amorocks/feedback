<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <title>Feedback</title>
        @stack('head')
    </head>
    <body>

        <nav class="navbar topnav navbar-dark bg-primary navbar-expand-lg justify-content-between">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="{{ route('home') }}">Feedback</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
                            <a class="nav-link" href="{{ route('home') }}">Start</a>
                        </li>
                        <li class="nav-item @if(Str::startsWith(Route::current()->uri, 'courses')) active @endif">
                            <a class="nav-link" href="{{ route('courses.index') }}">Vakken</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn-group d-none d-md-flex">
                @yield('buttons')
            </div>
        </nav>
        @yield('subnav')
        <div class="@yield('container', 'container mt-4')">
            @include('layouts.status')
            @yield('content')
        </div>
    </body>
</html>
