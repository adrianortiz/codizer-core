<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('plantilla/basic/css/basic.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">

    @yield('extra-css')

    <title>@yield('title', $tienda->nombre)</title>

</head>
<body>

<header>
    <div class="user-menu">

        <ul class="nav navbar-nav navbar-left">
            <li><a href="{{ route('login') }}">Codizer Shop</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            @if (Auth::guest())
                <li><a href="{{ route('login') }}">@lang('core.login')</a></li>
                <li><a href="{{ route('register') }}">@lang('core.register')</a></li>
            @else
                <li>
                    <a href="#">
                        <div><i class="fa fa-shopping-basket"> </i> <span class="txt-carrito">Carrito</span></div>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle tool-margin-right" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="icon-button"><img src="{{ asset('/media/photo-perfil/' . $userContacto[0]->foto) }}" class="img-user" width="20px" height="10px"> </span>
                        {{ $userContacto[0]->nombre }}
                        <span class="caret"></span>
                    </a>
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
    <div class="title-container">
        <a href="#" class="title-store">{{ $tienda->nombre }}</a>
    </div>
</header>

<nav>
    <ul>
        <li><a href="#" class="menu-selected">Home</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Home</a></li>
    </ul>
</nav>


@yield('cotent')


<footer>
    <strong>Texto importante, después de los h</strong>
    <span>Texto común</span>
</footer>

@yield('modals')

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/plantilla/basic/js/modal-plantilla-basic.js') }}"></script>

@yield('extra-js')

</body>
</html>