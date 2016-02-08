<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <title>{{ trans('welcome.title') }}</title>

    <link href="{{ asset('/css/welcome.materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/welcome.slider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/welcome.index.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/welcome.animate.min.css') }}" rel="stylesheet">


    {{-- {!! Htlm::style('css/index.css') !!} --}}


    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="alternate" title="shop RSS" type="application/rss+xml" href="/feed.rss" />

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

<div class="slider-img">
    <div id="slider-mac-codizer">
        <div id="mac-icon">
            <video src="{{ asset('/media/slider/demo.mp4') }}" poster="{{ asset('/media/slider/cover2.png') }}" loop controls> {{-- controls --}}
                Tu navegador no implementa el elemento <code>video</code>.
            </video>
        </div>
    </div>

    <div id="slider-os-codizer">
        <div class="devices-contain-codizer">
            <div class="device-apple"></div>
            <div class="device-android"></div>
            <div class="device-windows"></div>
            <div class="device-firefox"></div>
        </div>
        <div class="os-container-codizer">
            {{-- APPLE --}}
            <div class="slider-opcion-left-codizer" id="device-apple">
                <div class="btn-large waves-effect waves-grey obj-icon1-slider-codizer grey lighten-4 apple"></div>
                <div class="btn-large waves-effect waves-grey grey lighten-4 obj-slider-codizer">
                    <div class="obj-icon2-slider-codizer amber"></div>
                    <p class="light">{{ trans('welcome.ios') }}</p>
                </div>
            </div>

            {{-- ANDROID --}}
            <div class="slider-opcion-right-codizer" id="device-android">
                <div class="btn-large waves-effect waves-grey obj-icon1-slider-codizer green accent-4 android"></div>
                <div class="btn-large waves-effect waves-grey grey lighten-4 obj-slider-codizer">
                    <div class="obj-icon2-slider-codizer amber"></div>
                    <p class="light">{{ trans('welcome.android') }}</p>
                </div>
            </div>

            {{-- WINDOWS --}}
            <div class="slider-opcion-left-codizer left-codizer" id="device-windows">
                <div class="btn-large waves-effect waves-grey obj-icon1-slider-codizer light-blue accent-3 windows"></div>
                <div class="btn-large waves-effect waves-grey grey lighten-4 obj-slider-codizer">
                    <div class="obj-icon2-slider-codizer amber"></div>
                    <p class="light">{{ trans('welcome.windows') }}</p>
                </div>
            </div>

            {{-- FIREFOX OS --}}
            <div class="slider-opcion-right-codizer right-codizer" id="device-firefox">
                <div class="btn-large waves-effect waves-grey obj-icon1-slider-codizer orange lighten-1 firefox"></div>
                <div class="btn-large waves-effect waves-grey grey lighten-4 obj-slider-codizer">
                    <div class="obj-icon2-slider-codizer amber"></div>
                    <p class="light">{{ trans('welcome.fire_os') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="btn-cambio-slider1" class="waves-effect"></div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12 center">
                <h1 class="header light">{{ trans('welcome.your_store_online') }}</h1>
            </div>
        </div>
    </div>
</div>

<div id="tu-tienda-aqui-ahora" class="parallax-container">
    <h4 class="center light content_anim1" id="ani-text-tienda">{{ trans('welcome.your_store_here_now') }}</h4>
    <div class="row" id="ani-btn-registro">
        <div class="input-field col s12 m12 l12 center-align content_anim2">
            <a id="ani-btn-ini-reg" href="{{ url('/auth/register') }}" class="btn-large waves-effect waves-light btn-regist-codizer">{{ trans('welcome.begin_register') }}</a>
        </div>
        <div class="parallax"><img src="{{ asset('/media/@3x-fondo-form.png') }}" alt="Unsplashed background img 1"></div>
    </div>
</div>

<div id="simple-eficiente" class="negro-codizer">

    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m12">
                    <div class="icon-block">
                        <h4 class="center light content_anim3" id="ani-text-eficiente">{{ trans('welcome.simple_efficient') }}</h4>

                        <svg id="svg-referencia" width="687px" height="356px" viewBox="0 0 687 356" class="img-demo-codizer">

                            <defs>

                                <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-1">
                                    <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                    <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                    <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
                                    <feMerge>
                                        <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                                <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-2">
                                    <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                    <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                    <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
                                    <feMerge>
                                        <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                                <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-3">
                                    <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                    <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                    <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
                                    <feMerge>
                                        <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                                <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-4">
                                    <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                    <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                    <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
                                    <feMerge>
                                        <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                        <feMergeNode in="SourceGraphic"></feMergeNode>
                                    </feMerge>
                                </filter>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Simple-y-eficiente">
                                    <g id="lienas">
                                        <path d="M361.139271,83.1231925 L594.599349,83.4236834 L595.01571,216.484211 C595.188529,271.713534 550.558887,316.36979 495.334443,316.226755 L362.775492,315.883418" id="linea-rigth" stroke="#2DC8F8" stroke-width="2"></path>
                                        <circle id="Oval-rigth" fill="#1A91F2" r="10" cx="0" cy="0"></circle>
                                        <path d="M310.106228,83.1522723 L72.1601123,82.7451556 L71.6317247,215.407307 C71.4117566,270.634651 116.00949,315.42309 171.23574,315.445082 L308.915897,315.499909" id="linea-left" stroke="#2DC8F8" stroke-width="2"></path>
                                        <circle id="Oval-left" fill="#1A91F2" r="10" cx="0" cy="0"></circle>
                                    </g>
                                    <g id="bd" transform="translate(253.000000, 2.000000)">
                                        <rect id="bd-fondo" stroke="#FFFFFF" stroke-width="2" fill="#212121" x="0" y="27" width="150" height="108" rx="7"></rect>
                                        <rect id="bd-left" fill="#D3D3D3" x="7" y="35" width="22" height="90" rx="3"></rect>
                                        <rect id="bd-rigth-amarillo" fill="#F2D663" x="35" y="54" width="103" height="69" rx="3"></rect>
                                        <circle id="bd-circulo" fill="#F2D663" filter="url(#filter-1)" cx="143" cy="25" r="25"></circle>
                                        <path d="M143,14 C137.7,14 132,15.3 132,18 L132,32 C132,34.7 137.7,36 143,36 C148.3,36 154,34.7 154,32 L154,18 C154,15.3 148.3,14 143,14 L143,14 Z M143,16 C148.8,16 151.8,17.4 152,18 C151.8,18.6 148.8,20 143,20 C137.2,20 134.2,18.6 134,18 C134.2,17.4 137.2,16 143,16 L143,16 Z M134,20.4 C136.1,21.5 139.6,22 143,22 C146.4,22 149.9,21.5 152,20.4 L152,25 C151.8,25.6 148.8,27 143,27 C137.1,27 134.2,25.5 134,25 L134,20.4 L134,20.4 Z M143,34 C137.1,34 134.2,32.5 134,32 L134,27.4 C136.1,28.5 139.6,29 143,29 C146.4,29 149.9,28.5 152,27.4 L152,32 C151.8,32.5 148.9,34 143,34 L143,34 Z" id="bd-icon" fill="#000000"></path>
                                    </g>
                                    <g id="ajustes" transform="translate(508.000000, 4.000000)">
                                        <rect id="ajustes-fondo" stroke="#FFFFFF" stroke-width="2" fill="#212121" x="0" y="27" width="150" height="108" rx="7"></rect>
                                        <rect id="ajustes-left-morado" fill="#9774E1" x="12" y="37" width="22" height="90" rx="3"></rect>
                                        <rect id="ajustes-abajo-a" fill="#D3D3D3" x="41" y="94" width="44" height="31" rx="3"></rect>
                                        <rect id="ajustes-arriba-a" fill="#D3D3D3" x="41" y="40" width="44" height="48" rx="3"></rect>
                                        <rect id="ajustes-abajo-b" fill="#D3D3D3" x="94" y="94" width="44" height="31" rx="3"></rect>
                                        <rect id="ajustes-arriba-a" fill="#D3D3D3" x="94" y="40" width="44" height="48" rx="3"></rect>
                                        <circle id="ajustes-circulo" fill="#FFFFFF" filter="url(#filter-2)" cx="150" cy="25" r="25"></circle>
                                        <path d="M159,28 C160.7,28 162,26.7 162,25 C162,23.3 160.7,22 159,22 L158.5,22 C158.4,21.7 158.3,21.4 158.1,21.1 L158.5,20.7 C159.7,19.5 159.7,17.6 158.5,16.5 C157.3,15.3 155.4,15.3 154.3,16.5 L153.9,16.9 C153.6,16.8 153.3,16.6 153,16.5 L153,16 C153,14.3 151.7,13 150,13 C148.3,13 147,14.3 147,16 L147,16.5 C146.7,16.6 146.4,16.7 146.1,16.9 L145.7,16.5 C144.5,15.3 142.6,15.3 141.5,16.5 C140.3,17.7 140.3,19.6 141.5,20.7 L141.9,21.1 C141.8,21.4 141.6,21.7 141.5,22 L141,22 C139.3,22 138,23.3 138,25 C138,26.7 139.3,28 141,28 L141.5,28 C141.6,28.3 141.7,28.6 141.9,28.9 L141.5,29.3 C140.3,30.5 140.3,32.4 141.5,33.5 C142.7,34.7 144.6,34.7 145.7,33.5 L146.1,33.1 C146.4,33.2 146.7,33.4 147,33.5 L147,34 C147,35.7 148.3,37 150,37 C151.7,37 153,35.7 153,34 L153,33.5 C153.3,33.4 153.6,33.3 153.9,33.1 L154.3,33.5 C155.5,34.7 157.4,34.7 158.5,33.5 C159.7,32.3 159.7,30.4 158.5,29.3 L158.1,28.9 C158.2,28.6 158.4,28.3 158.5,28 L159,28 L159,28 Z M156.9,26 C156.7,27.2 156.3,28.3 155.6,29.2 L157,30.6 C157.4,31 157.4,31.6 157,32 C156.6,32.4 156,32.4 155.6,32 L155.6,32 L154.2,30.6 C153.3,31.3 152.2,31.8 151,31.9 L151,34 C151,34.6 150.6,35 150,35 C149.4,35 149,34.6 149,34 L149,31.9 C147.8,31.7 146.7,31.3 145.8,30.6 L144.4,32 C144,32.4 143.4,32.4 143,32 C142.6,31.6 142.6,31 143,30.6 L143,30.6 L144.4,29.2 C143.7,28.3 143.2,27.2 143.1,26 L141,26 C140.4,26 140,25.6 140,25 C140,24.4 140.4,24 141,24 L143.1,24 C143.3,22.8 143.7,21.7 144.4,20.8 L143,19.4 C142.6,19 142.6,18.4 143,18 C143.4,17.6 144,17.6 144.4,18 L144.4,18 L145.8,19.4 C146.7,18.7 147.8,18.2 149,18.1 L149,16 C149,15.4 149.4,15 150,15 C150.6,15 151,15.4 151,16 L151,18.1 C152.2,18.3 153.3,18.7 154.2,19.4 L155.6,18 C156,17.6 156.6,17.6 157,18 C157.4,18.4 157.4,19 157,19.4 L157,19.4 L155.6,20.8 C156.3,21.7 156.8,22.8 156.9,24 L159,24 C159.6,24 160,24.4 160,25 C160,25.6 159.6,26 159,26 L156.9,26 L156.9,26 Z M150,21 C147.8,21 146,22.8 146,25 C146,27.2 147.8,29 150,29 C152.2,29 154,27.2 154,25 C154,22.8 152.2,21 150,21 L150,21 Z M150,27 C148.9,27 148,26.1 148,25 C148,23.9 148.9,23 150,23 C151.1,23 152,23.9 152,25 C152,26.1 151.1,27 150,27 L150,27 Z" id="ajustes-icon" fill="#000000"></path>
                                    </g>
                                    <g id="user" transform="translate(1.000000, 7.000000)">
                                        <rect id="user-fondo" stroke="#FFFFFF" stroke-width="2" fill="#212121" x="0" y="23" width="150" height="108" rx="7"></rect>
                                        <rect id="user-left-rosa" fill="#FF2291" x="9" y="31" width="22" height="90" rx="3"></rect>
                                        <rect id="user-abajo" fill="#D3D3D3" x="37" y="86" width="103" height="34" rx="3"></rect>
                                        <rect id="user-arriba-rosa" fill="#FF2291" x="38" y="45" width="103" height="34" rx="3"></rect>
                                        <circle id="user-ciculo" fill="#FFFFFF" filter="url(#filter-3)" cx="140" cy="25" r="25"></circle>
                                        <path d="M144.2,25.3 C145.3,24.2 146,22.7 146,21 L146,18 C146,14.7 143.3,12 140,12 C136.7,12 134,14.7 134,18 L134,21 C134,22.7 134.7,24.2 135.8,25.3 C131.2,26 128,27.9 128,30 L128,32 C128,33.7 129.3,35 131,35 L149,35 C150.7,35 152,33.7 152,32 L152,30 C152,27.9 148.7,26 144.2,25.3 L144.2,25.3 Z M136,21 L136,18 C136,15.8 137.8,14 140,14 C142.2,14 144,15.8 144,18 L144,21 C144,23.2 142.2,25 140,25 C137.8,25 136,23.2 136,21 L136,21 Z M150,32 C150,32.6 149.6,33 149,33 L131,33 C130.4,33 130,32.6 130,32 L130,30 C130,29.8 130.6,29 132.3,28.3 C134.3,27.5 137.1,27 140,27 C142.9,27 145.7,27.5 147.7,28.3 C149.4,29 150,29.8 150,30 L150,32 L150,32 Z" id="user-icon" fill="#000000"></path>
                                    </g>
                                    <g id="tienda" transform="translate(253.000000, 228.000000)">
                                        <rect id="tienda-fondo" stroke="#FFFFFF" stroke-width="2" fill="#212121" x="0" y="19" width="150" height="108" rx="7"></rect>
                                        <rect id="tienda-arriba-rojo" fill="#FF435A" x="10" y="28" width="131" height="39" rx="3"></rect>
                                        <rect id="tienda-left" fill="#D3D3D3" x="12" y="77" width="36" height="39" rx="3"></rect>
                                        <rect id="tienda-rigth" fill="#D3D3D3" x="55" y="78" width="85" height="39" rx="3"></rect>
                                        <circle id="tienda-circulo" fill="#FFFFFF" filter="url(#filter-4)" cx="145" cy="25" r="25"></circle>
                                        <path d="M150,18 L150,17 C150,14.2 147.8,12 145,12 C142.2,12 140,14.2 140,17 L140,18 L136,18 L136,33 C136,34.7 137.3,36 139,36 L151,36 C152.7,36 154,34.7 154,33 L154,18 L150,18 L150,18 Z M142,17 C142,15.3 143.3,14 145,14 C146.7,14 148,15.3 148,17 L148,18 L142,18 L142,17 L142,17 Z M152,33 C152,33.6 151.6,34 151,34 L139,34 C138.4,34 138,33.6 138,33 L138,20 L152,20 L152,33 L152,33 Z" id="tienda-icon" fill="#000000"></path>
                                    </g>
                                </g>
                            </g>

                            <animateMotion
                                    xlink:href="#Oval-left"
                                    dur="5s"
                                    begin="0s"
                                    fill="freeze"
                                    repeatCount="indefinite">
                                <mpath xlink:href="#linea-left" />
                            </animateMotion>

                            <animateMotion
                                    xlink:href="#Oval-rigth"
                                    dur="5s"
                                    begin="0s"
                                    fill="freeze"
                                    repeatCount="indefinite">
                                <mpath xlink:href="#linea-rigth" />
                            </animateMotion>

                        </svg>

                        <p class="light content_anim4">{{ trans('welcome.admin_your_store') }}</p>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="separador-codizer"></div>
</div>


<div id="todo-genial-precio" class="container blanco-codizer">
    <div class="section">

        <div class="row">
            <div class="col s12 center">
                <h4 class="center light content_anim5">{{ trans('welcome.great_price') }}</h4>
                <h5 class="content_anim6">{{ trans('welcome.try_pay_later') }}</h5>

                <div class="col l2 gris0-codizer"></div>

                <div class="col m4 l3 gris1-codizer light content_anim7">
                    {{ trans('welcome.money') }}
                </div>

                <div class="col m8 l6 gris2-codizer content_anim8">
                    <P class="light">{{ trans('welcome.desc_price') }}</P>
                </div>

                <p class="col s12 light content_anim9">{{ trans('welcome.desc_to_try') }}</p>

            </div>

            <div class="input-field col s12 m12 l12 content_anim10">
                <a class="btn-large waves-effect waves-light btn-regist-codizer2 light" href="#">{{ trans('welcome.how_works') }}</a>
            </div>

        </div>

    </div>
    <div class="separador-codizer"></div>
</div>



<div id="increibles-disenos" class="negro-codizer">

    <div class="container">
        <div class="section">

            {{--  Icon Section   --}}
            <div class="row">
                <div class="col s12 m12">
                    <div class="icon-block content_anim11">
                        <h4 class="center light">{{ trans('welcome.designs') }}</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 content_anim12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="active" href="#test1">{{ trans('welcome.desktop') }}</a></li>
                        <li class="tab col s3"><a href="#test2">{{ trans('welcome.mobil') }}</a></li>
                    </ul>
                </div>

                {{-- Escritorio --}}
                <div id="test1" class="col s12">
                    <img class="materialboxed aling-img-codizer content_anim13" width="30%" height="auto" src="{{ asset('/media/desk/desk-b.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim14" width="30%" height="auto" src="{{ asset('/media/desk/desk-d.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim15" width="30%" height="auto" src="{{ asset('/media/desk/desk-c.jpg') }}">
                    {{--
                    <img class="materialboxed aling-img-codizer" width="30%" src="{{ asset('/media/desk/desk-f.jpg') }}">
                    <img class="materialboxed aling-img-codizer" width="30%" src="{{ asset('/media/desk/desk-g.jpg') }}">
                    <img class="materialboxed aling-img-codizer" width="30%" src="{{ asset('/media/desk/desk-e.jpg') }}">
                    <img class="materialboxed aling-img-codizer" width="30%" src="{{ asset('/media/desk/desk-h.jpg') }}">
                    <img class="materialboxed aling-img-codizer" width="30%" src="{{ asset('/media/desk/desk-a.jpg') }}">
                    --}}
                </div>
                {{-- FIN Escritorio --}}

                {{-- Movil --}}
                <div id="test2" class="col s12">
                    <img class="materialboxed aling-img-codizer content_anim16" width="23%" height="auto" src="{{ asset('/media/movil/movil-a.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim17" width="23%" height="auto" src="{{ asset('/media/movil/movil-b.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim18" width="23%" height="auto" src="{{ asset('/media/movil/movil-c.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim19" width="23%" height="auto" src="{{ asset('/media/movil/movil-d.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim20" width="23%" height="auto" src="{{ asset('/media/movil/movil-e.jpg') }}">
                    <img class="materialboxed aling-img-codizer content_anim21" width="23%" height="auto" src="{{ asset('/media/movil/movil-f.jpg') }}">
                </div>
                {{-- FIN Movil --}}

            </div>

        </div>
    </div>
    <div class="separador-codizer"></div>
</div>


<footer id="contacto-y-comparte" class="page-footer teal">
    <div class="container">
        <div class="row">

            <div class="col l4 s12 content_anim22">

                <h3 class="black-text ">{{ trans('welcome.contact_us') }}</h3>
                <div class="separador-linea-codizer"></div>
                <ul>
                    <li><a href="mailto:contacto@codizer.com" class="light">{{ trans('welcome.mail') }}</a></li>
                    <li class="light">{{ trans('welcome.phone') }}</li>
                </ul>
            </div>

            <div class="col l4 s12 content_anim23">
                <h3 class="black-text">{{ trans('welcome.share') }}</h3>
                <div class="separador-linea-codizer"></div>
                <ul>
                    <li><a class="black-text light" href="#!">{{ trans('welcome.facebook') }}</a></li>
                    <li><a class="black-text light" href="#!">{{ trans('welcome.twitter') }}</a></li>
                </ul>
            </div>

            <div class="col l4 s12 content_anim24">
                <h3 class="black-text">{{ trans('welcome.language') }}</h3>
                <div class="separador-linea-codizer"></div>
                <ul>
                    <li><a class="black-text light" href="{{ url('lang', ['en']) }}">{{ trans('welcome.english') }}</a></li>
                    <li><a class="black-text light" href="{{ url('lang', ['es']) }}">{{ trans('welcome.spanish') }}</a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="footer-copyright">
        <div class="container center content_anim1">
            <a class="" href="{{ url('/') }}">
                <div id="#footer-icon"></div>
            </a>
            <div class="row col l6 menu-codizer content_anim1">
                <a class=""  href="{{ url('/') }}">{{ trans('welcome.home') }}</a>
                <a class="" href="#">{{ trans('welcome.price') }}</a>
                <a class="" href="{{ route('login') }}">{{ trans('welcome.register') }}</a>
                <a class="" href="#">{{ trans('welcome.sign_in') }}</a>
                <a class="" href="#">{{ trans('welcome.terms') }}</a>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('/js/jquery.min.js') }}"></script>

<script src="{{ asset('/js/welcome/jquery.gsap.min.js') }}"></script>
<script src="{{ asset('/js/welcome/TweenMax.min.js') }}"></script>
<script src="{{ asset('/js/welcome/slider.js') }}"></script>

<script src="{{ asset('/js/welcome/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/js/welcome/materialize.min.js') }}"></script>
<script src="{{ asset('/js/welcome/init-index.js') }}"></script>

</body>
</html>