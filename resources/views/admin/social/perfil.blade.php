@extends('layout-core')

@section('title', 'Social')

@section('title-header', 'Social')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection

@section('extra-css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/core.container.ui.css') }}">
@endsection


    @section('main-header-options-app')

        @include('partials.perfil-link')
        @include('partials.contacts-link')

        <!-- Title menu -->
        <!--
        <a href="#" class="core-menu-list"><div>Información</div></a>
        -->

        <!-- list menu with img -->
        <!--
        <a href="#" class="core-menu-list menu-list-option menu-lis-img">
            <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
            <div>Karen Olvera</div>
        </a>
        -->

        <!--
        <a href="#" class="core-menu-list"><div>Menu list <span>10</span></div></a>

        <a href="#" class="core-menu-list menu-list-option"><div>Option 1</div></a>
        <a href="#" class="core-menu-list menu-list-option"><div>Option 2</div></a>
        -->

    @endsection


@section('options-tools')
    <!-- <div id="options-tools"></div>-->
@endsection


@section('extra-content')
    <!--
    <div id="container-video">
        <video width="100%" height="100%" autoplay>
            <source src="{{ asset('/media/video-perfil/chanel123.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    -->
    <div id="container-img-perfils">

        @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
            <!-- Comprobar que el perfil pertenece al usuario logueado -->
            <div id="form-cover-perfil-store">
                <!-- FORMULARIO CAMBIAR COVER -->
                {!! Form::open(['route' => 'cover.store', 'method' => 'POST', 'files' => true, 'id' => 'form-cover-to-store', 'class' => 'form-inline']) !!}
                    {!! Form::hidden('id', $userPerfil[0]->id) !!}
                    <div class="upload-cover">
                        {!! Form::file('file', ['id' => 'btn-file-cover-store', 'class' => 'form-control', 'required', 'accept' => 'image/jpg,image/png']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div id="view-subiendo-cover">
                <div>
                    <svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><g fill="none" stroke-linecap="round"><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#2C2C2C" stroke-width="10"></path><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#3997ee" stroke-width="4"><animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="502"></animate><animate attributeName="stroke-dasharray" dur="2s" repeatCount="indefinite" values="150.6 100.4;1 250;150.6 100.4"></animate></path></g></svg>
                </div>
            </div>
        @endif

        <img src="{{ asset('/media/photo-perfil-perfil/' . $perfil[0]->cover) }}">
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
            @if( !($userPerfil[0]->perfil_route == $perfil[0]->perfil_route) )
                @if($amIFollower === 0)
                    <a href="#" class="btn" role="button" title="Comenzar a seguir">+ Seguir</a>
                @else
                    <a href="#" class="btn" role="button" title="Dejar de seguir">- Seguir</a>
                @endif
            @else
                <button href="#" class="btn" role="button" title="Dejar de seguir"> - </button>
            @endif
        </div>
        <div id="options-menu-amigo" class="dropdown">
            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                + Amigo
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu container-add-friend" aria-labelledby="dropdownMenu1">
                @if( !($userPerfil[0]->perfil_route == $perfil[0]->perfil_route) )
                    @if($isMyFriend === 0)
                        <li><a id="btn-add-delete-friend" href="#">Agregar como amigo</a></li>
                    @else
                        <li><a id="btn-add-delete-friend" href="#">Quitar de mis amigo</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
@endsection


@section('article-content')
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

                        <button class="btn-shadow-blue">Publicar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div id="general-posts-content">

            </div>
        </div>

        <div id="content-candidate-and-tags">
            <!-- Title menu -->
            <a href="#" class="core-menu-list"><div style="color: red">Posibles candidatos</div></a>

            <!-- list menu with img -->
            @forelse($candidatesUsers as $candidate)

                <a href="{{ route('perfil', [$candidate->perfil_route]) }}" class="core-menu-list menu-list-option menu-lis-img">
                    <img src="{{ asset('/media/photo-perfil/' . $candidate->foto) }}">
                    <div>{{ $candidate->nombre . ' ' . $candidate->ap_paterno }}</div>
                </a>

            @empty

                <div id="core-contacts-container">
                    <a href="#0" class="core-menu-list menu-list-option"><div>No hay candidatos</div></a>
                </div>

            @endforelse


            <a href="#" class="core-menu-list"><div style="color: red">Tendencias</div></a>

            @forelse($tendencies as $tendencie)
                <a href="#" class="core-menu-list menu-list-option"><div>#{{ substr(str_replace(' ', '', ucwords($tendencie->nombre)), 0, 22) }}</div></a>
            @empty

                <div id="core-contacts-container">
                    <a href="#0" class="core-menu-list menu-list-option"><div>No hay candidatos</div></a>
                </div>

            @endforelse

        </div>
    </div>

    <!-- TO FRIEND -->
    {!! Form::open(['route' => 'contacto.to.friend', 'method' => 'GET', 'id' => 'form-add-to-friend']) !!}
    {!! Form::hidden('id', $idUserView->id) !!}
    {!! Form::close() !!}

    <!-- TO FALLOWER -->
    {!! Form::open(['route' => 'contacto.to.follower', 'method' => 'GET', 'id' => 'form-add-to-fallower']) !!}
    {!! Form::hidden('id', $idUserView->id) !!}
    {!! Form::close() !!}

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-perfil.js') }}"></script>
@endsection