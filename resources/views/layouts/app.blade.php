<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF token --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    {{-- Collapsed Hamburger --}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}"> {{-- Branding title of image. --}}
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav"> {{-- Left Side Of Navbar --}}
                        @if (auth()->check()) {{-- Current user is authencated. --}}
                            <li>
                                <a href="">
                                    <span class="fa fa-users" aria-hidden="true"></span> Users
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('support.index') }}">
                                    Support tickets
                                </a>
                            </li>
                        @endif
                    </ul>

                    {{-- Right Side Of Navbar --}}
                    <ul class="nav navbar-nav navbar-right">
                        @if (auth()->check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ $user->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="">
                                            <span class="fa fa-wrench" aria-hidden="true"></span> Account instellingen
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span class="fa fa-sign-out" aria-hidden="true"></span> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
