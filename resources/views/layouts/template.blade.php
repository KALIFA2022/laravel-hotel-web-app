<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/png">
        <title>{{ __('Hotel Hebat') }}</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('template/vendors/linericon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/nice-select/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/bootstrap.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/responsive.css') }}">
    </head>
    <body>
        <!--================Header Area =================-->
        <header class="header_area">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('landing') }}"><h5>{{ __('Hotel Hebat') }}</h5></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Basculer la navigation') }}">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">{{ __('Accueil') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#facilities">{{ __('Installations') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">{{ __('À propos') }}</a></li>
                            @guest
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> {{ __('Connexion/Inscription') }}</a></li>
                            @else
                                <li class="nav-item submenu dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->role == "customer")
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('customer.transactions') }}"><i class="fas fa-exchange-alt"></i>
                                                    {{ __('Liste des Transactions') }}
                                                </a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt"></i> {{ __('Déconnexion') }}
                                            </a>
                                        </li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->
        @yield('content')

        <footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">{{ __('À propos de l\'agence') }}</h6>
                            <p>{{ __('Description de l\'agence') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">{{ __('Newsletter') }}</h6>
                            <p>{{ __('Description de la newsletter') }}</p>
                            <div id="mc_embed_signup"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h6 class="footer_title">{{ __('InstaFeed') }}</h6>
                            <ul class="list_style instafeed d-flex flex-wrap">
                                <li><img src="{{ asset('template/image/instagram/Image-01.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-02.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-03.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-04.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-05.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-06.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-07.jpg') }}" alt=""></li>
                                <li><img src="{{ asset('template/image/instagram/Image-08.jpg') }}" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="border_line"></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-sm-12 footer-text m-0">{{ __('Copyright © :year Tous droits réservés', ['year' => date('Y')]) }}</p>
                    <div class="col-lg-4 col-sm-12 footer-social">
                        <a href="#"><i class="fa fa-facebook" aria-label="{{ __('Facebook') }}"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-label="{{ __('Twitter') }}"></i></a>
                        <a href="#"><i class="fa fa-dribbble" aria-label="{{ __('Dribbble') }}"></i></a>
                        <a href="#"><i class="fa fa-behance" aria-label="{{ __('Behance') }}"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('template/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('template/js/popper.js') }}"></script>
        <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('template/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('template/js/mail-script.js') }}"></script>
        <script src="{{ asset('template/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('template/vendors/nice-select/js/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('template/js/mail-script.js') }}"></script>
        <script src="{{ asset('template/js/stellar.js') }}"></script>
        <script src="{{ asset('template/vendors/lightbox/simpleLightbox.min.js') }}"></script>
        <script src="{{ asset('template/js/custom.js') }}"></script>
        @yield('script')
        <script>
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        </script>
    </body>
</html>
