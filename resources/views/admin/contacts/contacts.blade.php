@extends('layout-core')

@section('title', 'Contactos')

@section('title-header', 'Contactos')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

    <a href="#" class="core-menu-list"><div>Seguidores</div></a>
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
                <div id="btn-group-to-product" class="btn-group left" role="group" aria-label="...">
                    <button type="button" id="btn-new-contact" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalNewContact">Nuevo contacto</button>
                </div>
                <div id="btn-group-to-product" class="btn-group right" role="group" aria-label="...">
                    <button type="button" id="btn-edit-contact" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalUpdateContact">Editar</button>
                    <button type="button" id="btn-delete-contact" class="btn btn-default btn-sm">Eliminar</button>
                </div>

            </div>
        </div>
    @endsection

    <div class="left-content-list">
        <table class="table table-hover">
            <tbody>

            @forelse($friends as $friend)
                <tr class="data-contacto-tr" data-contacto="{{ $friend -> id }}">
                    <td class="container-list-photo-user">
                        <img src="{{ asset('/media/photo-perfil/' . $friend -> foto) }}">
                    </td>
                    <td>
                        <div class="list-contact-full-name">{{ $friend -> nombre. ' ' .$friend -> ap_paterno }} </div>
                        <span class="list-contact-mail">{{ $friend -> email }}</span><br/>
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
    <div class="right-content-list">
        <div id="msg-vacio">Ningún contacto seleccionado.</div>
    </div>
    @endsection

@section('extra-js')
    <script src="{{ asset('/js/core-contacts.js') }}"></script>
@endsection