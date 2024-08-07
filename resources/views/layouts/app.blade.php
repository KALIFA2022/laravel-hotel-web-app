<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Hotel Hebat') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('#home') }}">
                    {{ __('Hotel Hebat') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Basculer la navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roomtype.index') }}">{{ __('Types de chambres') }}</a>
                                </li>

                            @elseif(Auth::user()->role == 'resepsionis')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.logs') }}">{{ __('Journaux') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.checkin') }}">{{ __('Enregistrement') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.checkin.pdata') }}">{{ __('Enregistrement avec données personnelles') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.reservations') }}">{{ __('Réservations') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#kamar">{{ __('Chambres') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#fasilitas">{{ __('Installations') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tentang">{{ __('À propos') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#kontak">{{ __('Contact') }}</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000); // <-- time in milliseconds
    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
