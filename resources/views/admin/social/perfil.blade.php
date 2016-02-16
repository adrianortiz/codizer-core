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

            <!-- Free option -->
            <a href="#" class="core-menu-list menu-list-option"><div>Perfil</div></a>

            <!-- Title menu -->
            <a href="#" class="core-menu-list"><div>Información</div></a>

            <!-- list menu with img -->
            <a href="#" class="core-menu-list menu-list-option menu-lis-img">
                <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
                <div>Karen Olvera</div>
            </a>

            <!-- list menu with img -->
            <a href="#" class="core-menu-list menu-list-option menu-lis-img">
                <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
                <div>Karen Olvera</div>
            </a>


            <a href="#" class="core-menu-list"><div>Menu list <span>10</span></div></a>

            <a href="#" class="core-menu-list menu-list-option"><div>Option 1</div></a>
            <a href="#" class="core-menu-list menu-list-option"><div>Option 2</div></a>

            <ul>
                <li><a href="#!">Opction 1</a></li>
            </ul>
        </div>
    </nav>
</section>




<section id="content">

    <header>
        <div id="options-core">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="btn btn-default btn-sm tool-margin-left-button" id="hide-show-main"><i class="fa fa-angle-left fa-lg"></i></button>
                    <a href="#" class="btn btn-sm tool-margin-left-button core-logo-global"><span>Codizer</span> Core [0.04]</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="#" class="user-menu-top tool-margin-right core-icons-tools core-search-icon-perfil">
                                    <div><i class="fa fa-search"></i></div>
                                </a>
                            </li>

                            <li class="dropdown user-menu-top">
                                <a href="#" class="dropdown-toggle tool-margin-right core-icons-tools" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <div id="notify-core-perfil">9999</div>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Notificaciones</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Karen te agrego</a></li>
                                    <li><a href="#">Karen te agrego</a></li>
                                </ul>
                            </li>

                            <li class="dropdown user-menu-top">
                                <a href="#" class="dropdown-toggle tool-margin-right" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="icon-button"><img src="{{ asset('/media/photo-perfil/' . $userContacto[0]->foto) }}" id="img-user-admin"></span>
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

            </nav>
        </div>

        <div id="options-tools">

            <!-- Tools top -->

        </div>
    </header>

    <div id="container-video">
        <video width="100%" height="100%" autoplay> <!-- autoplay -->
            <source src="{{ asset('/media/video-perfil/chanel123.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div id="menu-posts-perfil-container">
        <div id="options-menu-post-container">
            <a class="btn" href="#" role="button">Producto</a>
            <a class="btn active" href="#" role="button">Estado</a>
            <a class="btn" href="#" role="button">Archivo</a>
            <a class="btn" href="#" role="button">Foto</a>
            <a class="btn" href="#" role="button">Video</a>
        </div>
        <div id="options-menu-seguir">
            <a class="btn" href="#" role="button">+ Seguir</a>
        </div>
        <div id="options-menu-amigo" class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                + Amigo
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#">Agregar como amigo</a></li>
                <li><a href="#">Enviar mensaje</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Bloquear</a></li>
            </ul>
        </div>
    </div>

    <article id="article-content">

        <div id="posts-perfil">
            <div id="content-post-perfil-and-form">

                <div id="form-posts-add">
                    <div class="form-group">
                        {!! Form::open(['route' => ['admin.colecciones.form.data.store'], 'method' => 'GET', 'id'=>'save-data']) !!}
                            <label for="estado">Publicar Estado</label>
                            <textarea id="estado" class="form-control" rows="3" placeholder="¡Escribe algo genial!"></textarea>
                            <div id="box-create-post">
                                <select>
                                    <option>Como {{ $userContacto[0]->nombre . ' ' . $userContacto[0]->ap_paterno }}</option>
                                    <option>Como Empresa</option>
                                </select>

                                <button>Publicar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div id="general-posts-content">

                </div>
            </div>

            <div id="content-candidate-and-tags">

            </div>
        </div>

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