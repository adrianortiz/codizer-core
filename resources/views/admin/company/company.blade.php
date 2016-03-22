@extends('layout-core')

@section('title', 'Empresa / Tienda')

@section('title-header', 'Empresa / Tienda')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    <a href="#" class="core-menu-list"><div>Empresa</div></a>
    <a href="#" id="btn-list-all-notes" class="core-menu-list menu-list-option"><div>Todas las notas</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Notas compartidas</div></a>

@endsection


@section('article-content')

@section('extra-content')
    @include('admin.company.partials.tags')
@endsection

<div id="continaer-note-shows" class="right-content-list content-complete-high">
    <!-- <div id="msg-vacio">Ninguna nota seleccionada.</div> -->
    <!-- <div class="block-content-info"></div> -->

    <div class="container-list-something">
        <div class="container-company-store-logo">
            <div class="container-company-store-logo-line"></div>
            <img src="{{ asset('/media/photo-company/adidas-company.png') }}">
        </div>
        <div id="show-info-contact-empresa" class="core-show-sub-title">Empresa</div>
        <div class="core-show-title-blue">Nov Joshelyn</div>
        <div>
            <div>Giro de la empresa</div>
            <div class="show-info-general">Moda</div>
        </div>
        <div>
            <div>RFC</div>
            <div class="show-info-general">IOMA902343SDF23</div>
        </div>
        <div>
            <div>Sector</div>
            <div class="show-info-general">Privado</div>
        </div>
        <div>
            <div>Página web</div>
            <div class="show-info-general">www.nov-joshelyn.com</div>
        </div>
        <div>
            <div>Dirección</div>
            <div class="show-info-general">Moneda no 22, Ciudad de México</div>
        </div>
        <div>
            <div>Telefono</div>
            <div class="show-info-general">(55) 29 26 01 08</div>
        </div>
        <div>
            <div>Fax</div>
            <div class="show-info-general">(55) 29 26 01 08</div>
        </div>
        <div>
            <div>Correo</div>
            <div class="show-info-general">ventas@novjoshelyn.com</div>
        </div>
        <div>
            <div>Idioma</div>
            <div class="show-info-general">Español</div>
        </div>
        <div>
            <div>Pais</div>
            <div class="show-info-general">México</div>
        </div>
    </div>
</div>
@endsection

@section('modals')

    @include('admin.Notes.patials.modal-nota')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-notes.js') }}"></script>
@endsection