@extends('layout-core')

@section('title', 'Contactos')

@section('title-header', 'Contactos')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

    <a href="#" class="core-menu-list menu-list-option"><div>Ver todos</div></a>
@endsection






@section('article-content')

    @section('extra-content')
        <div class="options-tools-list">
            <div class="left-content-list-tool">

                <div id="core-search-group" class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button id="core-search-group-btn" class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
                </span>
                </div>

            </div>

            <div class="right-content-list-tool">
                <div id="btn-group-to-contact" class="btn-group left" role="group" aria-label="...">
                    <button type="button" id="btn-new-contact" class="btn btn-default btn-sm">Nuevo contacto</button> <!-- data-toggle="modal" data-target="#modalNewContact" -->
                </div>
                <div id="btn-group-to-contact" class="btn-group right" role="group" aria-label="...">
                    <button type="button" id="btn-edit-contact" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalUpdateContact">Editar</button>
                    <button type="button" id="btn-delete-contact" class="btn btn-default btn-sm">Eliminar</button>
                </div>

            </div>
        </div>
    @endsection

    <div class="left-content-list">
        <table class="table table-hover">
            <tbody id="list-contacts">

            @forelse($friends as $friend)
                <tr class="data-contacto-tr" data-contacto="{{ $friend -> id }}">
                    <td class="container-list-photo-user">
                        <img src="{{ asset('/media/photo-perfil/' . $friend -> foto) }}">
                    </td>
                    <td>
                        <div class="list-contact-full-name">{{ $friend -> nombre. ' ' .$friend -> ap_paterno }} </div>
                        <span class="list-contact-mail">{{ $friend -> email }}</span>
                    </td>
                </tr>
                @empty
                <tr class="data-contacto-tr">
                    <td class="list-contact-full-name">
                        No hay contactos.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

    <div id="continer-contact-shows" class="right-content-list">
        <div id="msg-vacio">Ningún contacto seleccionado.</div>

        <div class="block-content-info-contact" id="info-contact">
            <div class="container-show-info-contact-a">

                <!-- LOS ID EN SU MAYORIA SON PARA QUE IDENTIFIQUES A LOS ELEMENTOS CON JS Y PUEDAS MODIFICAR LA INFORMACIÓN -->

                <div id="show-info-contact-empresa" class="core-show-sub-title">Codizer</div>
                <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Adrian Ortiz martinez</div>
            </div>

            <div class="container-show-info-contact-img-b">
                <img id="show-info-contact-foto" src="{{ asset('/media/photo-perfil/unknow.png') }}">
                <a id="show-perfil-contact-link" href="#" class="btn btn-sm-radius btn-shadow-blue">Ver perfil</a>

                <!-- USA UN FOR PARA IMPRIMIR LAS REDES SOCIALES QUE TIENE CADA CONTACTO -->
                <a id="UsaElIDQueMasTeGuste" href="#" class="btn btn-social-radius btn-shadow-white"><i class="fa fa-facebook"></i></a>
                <a id="UsaElIDQueMasTeGuste" href="#" class="btn btn-social-radius btn-shadow-white"><i class="fa fa-linkedin"></i></a>
                <a id="UsaElIDQueMasTeGuste" href="#" class="btn btn-social-radius btn-shadow-white"><i class="fa fa-twitter"></i></a>
            </div>

            <div class="container-show-info-contact-list-c">
                <div>
                    <div>Profesión</div>
                    <!-- PUEDES AGREGAR id="show-info-product-cantidad" PARA IDENTIFICAR CADA ELEMENTO CON JS -->
                    <div id="show-info-contact-profesion" class="show-info-contact">Ventas Chanel</div>
                </div>
                <div>
                    <div>Telefono</div>
                    <div id="show-info-contact-telefono" class="show-info-contact">(55) 29 26 01 08</div>
                </div>
                <div>
                    <div>Sexo</div>
                    <div class="show-info-contact">Mujer</div>
                </div>
                <div>
                    <div>Algo más</div>
                    <div class="show-info-contact">Información</div>
                </div>
            </div>

            <div class="container-list-something">
                <div class="core-show-title-blue">Descripción</div>
            </div>
            <div id="show-info-contact-desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</p>
            </div>

            <div class="container-list-something">
                <div class="core-show-title-blue">Más información</div>
                <div>
                    <div>Telefono celular</div>
                    <div class="show-info-contact">(55) 044 12 45 67 89</div>
                </div>
                <div>
                    <div>Telefono celular</div>
                    <div class="show-info-contact">(55) 044 12 45 67 89</div>
                </div>
                <div>
                    <div>Telefono celular</div>
                    <div class="show-info-contact">(55) 044 12 45 67 89</div>
                </div>
            </div>
        </div>

        <div id="form">
            @include('admin.contacts.patials.form-contacts')
        </div>
    </div>
@endsection

@section('modals')

    @include('admin.contacts.patials.modal-contacto')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-contacts.js') }}"></script>
@endsection