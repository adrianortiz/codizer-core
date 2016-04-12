<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('plantilla/pro/css/pro.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('plantilla/pro/css/shop-homepage.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">

    @yield('extra-css')

    <title>@yield('title', $tienda->nombre)</title>

</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: rgba(0, 0, 0, 0.8);">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-align-left" aria-hidden="true" style="color: #FFF;"></i>
            </button>
            <a class="navbar-brand" href="{{ route('store.front', $tienda->store_route) }}" style="background-color: #1E74D0; color: #FFF;">{{ $tienda->nombre }}</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a id="tag-home" href="{{ route('store.front', $tienda->store_route) }}">Inicio</a></li>
                <li><a id="tag-info" href="{{ route('store.front.info', $tienda->store_route) }}">Acerca de</a></li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Opciones</p>
            <div class="list-group">

                <a href="{{ route('store.front.product.orden.show', [$tienda->store_route]) }}" class="list-group-item"><i class="fa fa-shopping-basket"> </i> <span class="txt-carrito">Carrito</span></a>

                @if (Auth::guest())
                    <a href="{{ route('login') }}" class="list-group-item">@lang('core.login')</a>
                    <a href="{{ route('register') }}" class="list-group-item">@lang('core.register')</a>
                @else
                    <a href="{{ route('perfil', $userPerfil[0]->perfil_route) }}" class="list-group-item"><img src="{{ asset('/media/photo-perfil/' . $userContacto[0]->foto) }}" class="img-user" width="16px" height="16px" style="margin-right: 5px">@lang('core.perfil')</a>
                    <a href="{{ route('logout') }}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i> @lang('core.logout')</a>
                @endif
            </div>
        </div>

        <div class="col-md-9">

            @yield('carousel')

            <div class="row container-products">
                @yield('cotent')

            </div>

        </div>

    </div>

</div>
<!-- /.container -->



<div class="container">

    <hr>
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; {{ $tienda->nombre }} & Codizer - 2016</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

@yield('modals')

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/plantilla/pro/js/modal-plantilla-pro.js') }}"></script>

@yield('extra-js')

</body>
</html>