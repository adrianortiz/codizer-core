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
                <div id="btns-group-to-contact" class="btn-group right core-hidden" role="group" aria-label="...">
                    <button type="button" id="btn-edit-contact" class="btn btn-default btn-sm">Editar</button>
                    <button type="button" id="btn-delete-contact" class="btn btn-default btn-sm">Eliminar</button>
                </div>

            </div>
        </div>
    @endsection

    <div class="left-content-list">
        <table class="table table-hover">
            <tbody id="list-contacts">
            @forelse($contacts as $contact)
            <tr class="data-contacto-tr" data-contacto="{{ $contact -> id }}">
                <td class="container-list-photo-user">
                    <img src="{{ asset('/media/photo-perfil/' . $contact -> foto) }}">
                </td>
                <td>
                    <div class="list-contact-full-name">{{ $contact -> nombre. ' ' .$contact -> ap_paterno }} </div>
                    <span class="list-contact-mail">{{ $contact -> profesion }}</span>
                </td>
            </tr>
            @empty
                <div id="list-vacio">No hay contactos.</div>
            @endforelse
            </tbody>
        </table>
    </div>

    <div id="continer-contact-shows" class="right-content-list">
       <div id="msg-list-vacio">Ningún contacto seleccionado.</div>

       <div class="block-content-info-contact core-hidden" id="info-contact">
            <div class="container-show-info-contact-a">
                <div id="show-info-contact-empresa" class="core-show-sub-title">Contacto</div>
                <div id="show-info-contact-nombre-completo" class="core-show-title-blue"></div>
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
                    <div>Sexo</div>
                    <div class="show-info-contact" id="show-info-contact-sexo"></div>
                </div>

                <div>
                    <div>Fecha de nacimiento</div>
                    <div id="show-info-contact-f-nacimiento" class="show-info-contact"></div>
                </div>

                <div>
                    <div>Profesión</div>
                    <div id="show-info-contact-profesion" class="show-info-contact"></div>
                </div>

                <div>
                    <div>Estado civil</div>
                    <div id="show-info-contact-estado-civil" class="show-info-contact"></div>
                </div>

                <div>
                   <div>Descripción</div>
                   <div  class="show-info-contact" id="show-contact-desc-info"></div>
               </div>
            </div>

            <div id="core-info-contact-address">
                <div class="container-list-something" id="core-content-address">
                    <!-- Se agrega la informacion de la direccion por cada iteracion -->
                </div>

                <div class="col-md-12" id="show-info-contact-desc">
                    <div class="form-group">
                        <button id="btn-update-address" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Editar Dirección</button>
                    </div>
                </div>
            </div>

            <div id="core-info-contact-phone">
                <div class="container-list-something" id="core-content-phone">
                    <!-- Se agrega la informacion del telefono por cada iteracion -->
                </div>

                <div class="col-md-12" id="show-info-contact-desc">
                    <div class="form-group">
                        <button id="btn-update-phone" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Editar Teléfono</button>
                    </div>
                </div>
            </div>

           <div id="core-info-contact-mail">
               <div class="container-list-something" id="core-content-mail">
                   <!-- Se agrega la informacion del telefono por cada iteracion -->
               </div>

               <div class="col-md-12" id="show-info-contact-desc">
                   <div class="form-group">
                       <button id="btn-update-mail" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Editar Correo</button>
                   </div>
               </div>
           </div>

           <div id="core-info-contact-social">
               <div class="container-list-something" id="core-content-social">
                   <!-- Se agrega la informacion de redes sociales por cada iteracion -->
               </div>

               <div class="col-md-12" id="show-info-contact-desc">
                   <div class="form-group">
                       <button id="btn-update-social" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Editar Redes sociales</button>
                   </div>
               </div>
           </div>
        </div>

        <div id="form-register" class="core-hidden">
            @include('admin.contacts.patials.contact-register')
        </div>
        <div id="form-edit" class="core-hidden">
            @include('admin.contacts.patials.contact-edit')
        </div>
        <div id="address-edit" class="core-hidden">
            @include('admin.contacts.patials.address-edit')
        </div>
        <div id="phone-edit" class="core-hidden">
            @include('admin.contacts.patials.phone-edit')
        </div>
        <div id="mail-edit" class="core-hidden">
            @include('admin.contacts.patials.mail-edit')
        </div>
        <div id="social-edit" class="core-hidden">
            @include('admin.contacts.patials.social-edit')
        </div>

        {{-- Formulario seleccion de contacto --}}
        {!! Form::open(['route' => 'contact.show', 'method' => 'GET', 'id' => 'form-contact-show']) !!}
        {!! Form::hidden('id', 'null', ['id' => 'id-contact-to-show']) !!}
        {!! Form::close() !!}

        {{-- Formulario para eliminar contacto --}}
        {!! Form::open(['route' => 'contact.delete', 'method' => 'DELETE', 'id' => 'form-contact-delete']) !!}
        {!! Form::hidden('id', 'null', ['id' => 'id-contact-to-delete']) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('modals')

    @include('admin.contacts.patials.modal-contacto')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-contacts.js') }}"></script>
@endsection