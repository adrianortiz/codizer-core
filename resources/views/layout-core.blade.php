<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link type="text/css" rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/core.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    @yield('extra-css')

    <title>@yield('title', 'App')</title>

</head>

<body>


<header>
    <div id="options-core">
        <nav class="navbar navbar-default">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <div id="main-header" class="navbar-left">
                        <div id="main-header-app">
                            <div id="apps-icon"><span class="fa fa-th-large fa-lg"></span></div>
                            <div id="apps-name">
                                <span id="name-app-select">@yield('title-header', 'App')</span>
                                <span id="codizer-apps-select">Codizer apps</span>
                            </div>
                            <div id="apps-flecha"><span class="fa fa-angle-down fa-lg fa-rotate-180"></span></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default btn-sm navbar-left" id="hide-show-main"><i class="fa fa-angle-left fa-lg"></i></button>
                    <a href="#" class="btn btn-sm navbar-left core-logo-global"><span>@lang('core.codizer')</span> @lang('core.version')</a>
            </div>



            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">@lang('core.login')</a></li>
                        <li><a href="{{ route('register') }}">@lang('core.register')</a></li>
                    @else
                        <li>
                            <a href="#" class="user-menu-top tool-margin-right core-icons-tools core-search-icon-perfil" id="call-seach">
                                <div><i class="fa fa-search"></i></div>
                            </a>
                        </li>

                        <li class="dropdown user-menu-top">
                            <a href="#" class="dropdown-toggle tool-margin-right core-icons-tools" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div id="notify-core-perfil">9999</div>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">@lang('core.notifications')</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Karen @lang('core.add-you')</a></li>
                                <li><a href="#">Karen @lang('core.add-you')</a></li>
                            </ul>
                        </li>

                        <li class="dropdown user-menu-top">
                            <a href="#" class="dropdown-toggle tool-margin-right" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="icon-button"><img src="{{ asset('/media/photo-perfil/' . $userContacto[0]->foto) }}" id="img-user-admin"></span>
                                {{ $userContacto[0]->nombre }}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('perfil', $userPerfil[0]->perfil_route) }}">@lang('core.perfil')</a></li>
                                <li><a href="#">@lang('core.account')</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('logout') }}">@lang('core.logout')</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

        </nav>
    </div>

</header>



<div id="container-ui">

            <!-- <div id="options-tools"></div> -->
            <!-- <div style="width: 100%; height: 41px;"></div> -->

    <section id="main">
        @yield('main-header-info-app')
        <nav>
            <div id="main-header-options-app">
                @yield('main-header-options-app')
            </div>
        </nav>
    </section>

    <section id="content">

        @yield('extra-content')

        <article id="article-content">

            @yield('article-content')

        </article>
    </section>

</div>

@include('partials.search')
@include('partials.apps')

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/init-core.js') }}"></script>
<script src="{{ asset('/js/core-apps.js') }}"></script>
<script src="{{ asset('/js/core-search.js') }}"></script>
@yield('extra-js')

</body>
</html>