<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/core.css') }}"/>
    <link href='{{ asset('/css/font-awesome.min.css') }}' rel='stylesheet' type='text/css'>

    <title>Social</title>
</head>

<body>


<section id="main">

    <div id="main-header">
        <div id="main-header-app">
            <div>Social<span class="fa fa-angle-down fa-lg"></span></div>
        </div>
        <div id="main-header-info-app-perfil">
            <div id="contact-photo-perfil">
                <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
                <div>
                    <a href="#"><div id="chat-icon-perfil"><i class="fa fa-comment fa-lg fa-flip-horizontal"></i></div></a>
                    <a href="#"><div id="more-icon-perfil"><i class="fa fa-ellipsis-h fa-lg"></i></div></a>
                </div>
            </div>
            <div id="info-contact-perfil">
                <a href="">
                    <div id="name-perfil">{{ $contacto[0]->nombre . ' ' . $contacto[0]->ap_paterno }}</div>
                </a>
                <a href="">
                    <div>{{ $contacto[0]->profesion }}</div>
                </a>
            </div>

        </div>
    </div>

    <nav>
        <div id="main-header-options-app">
            <ul>
                <li><a href="#!">Opction 1</a></li>
            </ul>
        </div>
    </nav>
</section>




<section id="content">

    <header>
        <div id="options-core">






            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <button id="hide-show-main">Hide/Show</button>

                <ul class="nav navbar-nav">
                    @if (!Auth::guest())
                            <!-- <li><a href="{{ route('panel') }}">Panel</a></li> -->
                    @endif

                </ul>

                <ul class="nav navbar-nav ">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="#" class="user-menu-top">Ayuda</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user-menu-top" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="icon-button"><img src="{{ asset('/images/icon-user.svg') }}"></span>
                                {{ $userContacto[0]->nombre }}
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
        <div id="options-tools"></div>
    </header>

    <div id="container-video">
        <video width="100%" height="100%" autoplay>
            <source src="{{ asset('/media/video-perfil/chanel123.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <article id="article-content">
        <h1>Contenido</h1>
    </article>

</section>
<!--
<footer>
    <strong>Texto importante, después de los h</strong>
    <span>Texto común</span>
</footer>
-->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/init-core.js') }}"></script>

</body>
</html>