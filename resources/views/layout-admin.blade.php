<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">

    <title>@yield('title', 'App')</title>
</head>
<body>



<nav class="navbar navbar-fixed-top admin-menu-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('panel') }}"><img src="{{ asset('/images/logo.svg') }}"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                    <!-- <li><a href="{{ route('panel') }}">Panel</a></li> -->
                @endif

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a href="#" class="user-menu-top">Ayuda</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user-menu-top" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="icon-button"><img src="{{ asset('/images/icon-user.svg') }}"></span>
                                {{ Auth::user()->name }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('panel') }}">Cuenta</a></li>
                            <li><a href="#">Acerca de...</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="admin-menu-left">

</div>
<div class="admin-menu-left-list">
    <ul>
        <li><p>Administración</p></li>
        <li><a href="{{ route('panel') }}"><div><span><img src="{{ asset('/images/icon-user.svg') }}" class="icon-button"></span> Cuenta</div></a></li>
        <li><a href="{{ url('/admin/colecciones') }}"><div><span><img src="{{ asset('/images/icon-complements.svg') }}" class="icon-button"></span> Colecciones</div></a></li>
        <li><a href="{{ route('admin.statistics.index') }}"><div><span><img src="{{ asset('/images/icon-estadistica.svg') }}" class="icon-button"></span> Estadísticas</div></a></li>
        <li><p>Datos</p></li>
        <li><a href="#"><div><span><img src="{{ asset('/images/icon-codizer.svg') }}" class="icon-button"></span> Acerca de...</div></a></li>
    </ul>
</div>
<div class="admin-contanier-global">

@yield('content')



</div>

@include('admin.colections.complements.partials.alert-delete')

@yield('complements-builder')


<!-- Scripts -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

@yield('scripts')
</body>
</html>