<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <title>Codizer Shop by Codizer Dev</title>

    {!! Html::style('css/welcome.materialize.min.css') !!}
    <link href="{{ asset('/css/welcome.nav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/welcome.animate.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="alternate" title="shop RSS" type="application/rss+xml" href="/feed.rss" />

    <style>
        body {

            background-color: #F2F2F2;
            background-image: url('../media/bg-login.svg');
            background-position: center 0px;
            background-size: 1344px;
            background-repeat: no-repeat;

        }
    </style>
</head>
<body>

<div class="navbar-fixed">
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">

            <a id="logo-container" href="{{ url('/') }}" class="brand-logo"><div></div></a>

            <ul class="left hide-on-med-and-down">
                <li><a href="#" class="btn-flat"></a></li>
                <li><a href="#" class="btn-flat"></a></li>
                <li><a href="#" class="btn-flat"></a></li>
                <li><a href="{{ url('/#Precio') }}" class="light waves-effect">{{ trans('welcome.price') }}</a></li>
                <li><a href="{{ url('/#Contacto') }}" class="light waves-effect">{{ trans('welcome.contact') }}</a></li>
            </ul>

            <div class="right hide-on-med-and-down">
                <a href="{{ route('register') }}" class="waves-effect waves-light light btn btn-codizer-1">{{ trans('welcome.register') }}</a>
                <a href="{{ route('login') }}" class="waves-effect waves-light light btn  btn-codizer-2">{{ trans('welcome.sign_in') }}</a>
            </div>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="{{ url('/') }}">Codizer Shop</a></li>
                <li class="divider"></li>
                <li><a href="#Precio">{{ trans('welcome.price') }}</a></li>
                <li><a href="#Contacto">{{ trans('welcome.contact') }}</a></li>
                <li class="divider"></li>
                <li><a href="{{ url('/auth/register') }}">{{ trans('welcome.register') }}</a></li>
                <li class="divider divider-codizer"></li>
                <li><a href="{{ url('/home') }}" class="waves-effect waves-light btn btn-codizer-2">{{ trans('welcome.sing_in') }}</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse">
                <div id="icon-menu-codizer"></div>
            </a>
        </div>
    </nav>
</div>

@yield('content')

        <!--  Scripts-->

<script src="{{ asset('/js/jquery.min.js') }}"></script>

<script src="{{ asset('/js/welcome/jquery.gsap.min.js') }}"></script>
<script src="{{ asset('/js/welcome/TweenMax.min.js') }}"></script>
<script src="{{ asset('/js/welcome/slider.js') }}"></script>

<script src="{{ asset('/js/welcome/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/js/welcome/materialize.min.js') }}"></script>
<script src="{{ asset('/js/welcome/init-index.js') }}"></script>

@yield('scripts')

</body>
</html>
