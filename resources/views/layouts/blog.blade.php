<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title> @yield('title') </title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png')}}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

    @yield('css')

</head>

<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
    <div class="container">

        <div class="navbar-left">
            <a class="navbar-brand" href="{{route('welcome')}}">
                <img class="logo-dark" src="{{asset('img/logo-dark.png')}}" alt="logo">
                <img class="logo-light" src="{{asset('img/logo-light.png')}}" alt="logo">
            </a>

            @if(auth()->check())
                <div class="bg-primary">
                    <a class="nav-link text-success" href="{{auth()->check() ? route('home') : '#'}}">
                        @php
                            if(auth()->check()) {
                               $role = auth()->user()->role;

                               if($role === 'admin') {
                                   echo 'Admin Dash Board';
                                   }
                               else if($role === 'writer') {
                                   echo 'User Dash Board';
                                   }
                               }
                        @endphp
                    </a>
                </div>
            @endif

        </div>

        <div>
            <a class="btn btn-xs btn-round btn-success" href="{{route('login')}}">
                {{auth()->check() ? auth()->user()->name : 'Log in'}}

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    @if(auth()->check())
                        <button class="btn btn-xs btn-round btn-success" type="submit">
                           LOG OUT
                        </button>
                    @endif
                </form>
            </a>
         </div>

    </div>
</nav><!-- /.navbar -->


<!-- Header -->
@yield('header')

<!-- Main Content -->
@yield('content')

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row gap-y align-items-center">

            <div class="col-6 col-lg-3">
                <a href="/"><img src="{{asset('img/logo-dark.png')}}" alt="logo"></a>
            </div>

            <div class="col-6 col-lg-3 text-right order-lg-last">
                <div class="social">
                    <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i class="fa fa-facebook"></i></a>
                    <a class="social-twitter" href="https://twitter.com/thethemeio"><i class="fa fa-twitter"></i></a>
                    <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i
                            class="fa fa-instagram"></i></a>
                    <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i class="fa fa-dribbble"></i></a>
                </div>
            </div>

        </div>
    </div>
</footer><!-- /.footer -->


<!-- Scripts -->
<script src="{{ asset('js/page.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
