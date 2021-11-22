<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Instagram</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            {{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
            {{--                 {{ config('app.name', 'Laravel') }}--}}
            {{--                </a>--}}
            @isset(Auth::user()->id)
                <a href="/profile/{{Auth::user()->id}}" class="text-decoration-none">


                    @else
                        <a href="/login" class="text-decoration-none">
                            @endisset

                            <div class="d-flex align-items-center">
                                <div class="pr-3" style="border-right: solid #333"><img src="/Svg/icon.svg" alt=""
                                                                                        style="height: 30px; width: auto">
                                </div>
                                <span class="navbar-brand pl-3 ">Instagram</span></div>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->


                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif

                                @else

                                    {{-- Notification list start--}}
                                    <li id='nots'
                                        class="dropdown d-flex justify-content-center align-items-center mr-4">
                                        <a href="#" id="notific" class="dropdown-toggle"
                                           data-toggle="dropdown"
                                           role="button"
                                           aria-expanded="false">
                                            <span class="glyphicon glyphicon-globe"></span>
                                            Notifications <span class="caret"> </span>
                                        </a>
                                        <ul id="notifications_menu" class="dropdown-menu" role="menu">
                                        </ul>
                                    </li>
                                    {{-- Notification list end--}}

                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->username }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                </a>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{ route('notification') }}",
            method: 'get',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (result) {
                if (result.success) {
                    $('#notifications_menu').html(result.html);
                }
            },
        });
    });
</script>
</body>
</html>
