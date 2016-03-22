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
            <img src="{{ asset('/media/photo-company/' . $empresa->logo) }}">
        </div>
        <div id="show-info-contact-empresa" class="core-show-sub-title">Empresa</div>
        <div class="core-show-title-blue">{{ $empresa->nombre }}</div>
        <div>
            <div>Giro de la empresa</div>
            <div class="show-info-general">{{ $empresa->giro_empresa }}</div>
        </div>
        <div>
            <div>RFC</div>
            <div class="show-info-general">{{ $empresa->rfc }}</div>
        </div>
        <div>
            <div>Sector</div>
            <div class="show-info-general">{{ $empresa->sector }}</div>
        </div>
        <div>
            <div>Página web</div>
            <div class="show-info-general">{{ $empresa->pagina_web }}</div>
        </div>
        <div>
            <div>Dirección</div>
            <div class="show-info-general">{{ $empresa->direccion }}</div>
        </div>
        <div>
            <div>Telefono</div>
            <div class="show-info-general">{{ $empresa->tel }}</div>
        </div>
        <div>
            <div>Fax</div>
            <div class="show-info-general">{{ $empresa->fax }}</div>
        </div>
        <div>
            <div>Correo</div>
            <div class="show-info-general">{{ $empresa->correo }}</div>
        </div>
        <div>
            <div>Idioma</div>
            <div class="show-info-general">{{ $empresa->idioma }}</div>
        </div>
        <div>
            <div>Pais</div>
            <div class="show-info-general">{{ $empresa->pais }}</div>
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