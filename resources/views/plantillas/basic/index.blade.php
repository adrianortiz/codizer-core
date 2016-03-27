<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('plantilla/basic/css/basic.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">

    <title>{{ $tienda->nombre }}</title>
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

                <li class="dropdown user-menu-top">
                    <a href="#" class="dropdown-toggle tool-margin-right" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="icon-button"><img src="{{ asset('/media/photo-perfil/' . $userContacto[0]->foto) }}" class="img-user" width="20px" height="10px"> </span>
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


<section class="slider">
    <article>
        <div class="message">
            <div>{{ $tienda->nombre }}</div>
            <div>{{ $tienda->desc }}</div>
        </div>
        <img src="{{ asset('/plantilla/basic/media/cover.jpg') }}">
    </article>
</section>

<section class="title-basic-section">
    <article>
        <h3>Lo nuevo</h3>
    </article>
</section>

<section class="lo-nuevo">
    <article>

        <div class="product-container">
            <a href="#">
                <img src="{{ asset('/media/photo-product/sudadera-cat.png') }}">
            </a>

            <div class="lo-nuevo-info">
                <div><a href="#">Ropa para dama asdasdasd asdas dasdadad asdasd asdads</a></div>
                <div><a href="#">$144.50 <span>-10%</span></a></div>
                <div><a href="#" id="btn-view-modal" class="btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a> <a href="#" class="btn btn-sm">Agregar a carrito</a></div>
            </div>
        </div>



    </article>
</section>


<section class="title-basic-section">
    <article>
        <h3>Productos</h3>
    </article>
</section>



<section>
    <article>Contenido del body</article>
</section>

<footer>
    <strong>Texto importante, después de los h</strong>
    <span>Texto común</span>
</footer>



<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Información del producto</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                <h3>Nombre del producto</h3>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="btn-iniciar-compra" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Iniciar compra</button>
            </div>
        </div>
    </div>
</div>


<!-- <script type="text/javascript" src="js/script.js"></script> -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

<script>
    $('#btn-view-modal').click();
</script>
</body>
</html>