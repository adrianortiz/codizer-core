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
            <div class="container-company-store-logo-line">
                <button type="button" id="btn-update-company" class="btn btn-primary btn-sm btn-sm-radius right-btn-company" data-toggle="modal" data-target="#modalUpdateCompany">Editar Empresa</button>
                <button type="button" id="btn-down-company" class="btn btn-default btn-sm btn-sm-radius right-btn-company">Desactivar Empresa</button>
            </div>
            <img id="show-info-contact-logo" src="{{ asset('/media/photo-company/' . $empresa->logo) }}">
        </div>

        <div id="show-info-contact-empresa" class="core-show-sub-title">Empresa</div>
        <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $empresa->nombre }}</div>


    </div>

    <div class="container-list-something container-list-something-50">
        <div>
            <div>RFC</div>
            <div id="show-info-contact-rfc" class="show-info-general">{{ $empresa->rfc }}</div>
        </div>
        <div>
            <div>Sector</div>
            <div id="show-info-contact-sector" class="show-info-general">{{ $empresa->sector }}</div>
        </div>
        <div>
            <div>Página web</div>
            <div id="show-info-contact-pagina-web" class="show-info-general">{{ $empresa->pagina_web }}</div>
        </div>
        <div>
            <div>Dirección</div>
            <div id="show-info-contact-direccion" class="show-info-general">{{ $empresa->direccion }}</div>
        </div>
        <div>
            <div>Teléfono</div>
            <div id="show-info-contact-tel" class="show-info-general">{{ $empresa->tel }}</div>
        </div>
    </div>

    <div class="container-list-something container-list-something-50">
        <div>
            <div>Giro de la empresa</div>
            <div id="show-info-contact-giro-empresa" class="show-info-general">{{ $empresa->giro_empresa }}</div>
        </div>

        <div>
            <div>Fax</div>
            <div id="show-info-contact-fax" class="show-info-general">{{ $empresa->fax }}</div>
        </div>
        <div>
            <div>Correo</div>
            <div id="show-info-contact-correo" class="show-info-general">{{ $empresa->correo }}</div>
        </div>
        <div>
            <div>Idioma</div>
            <div id="show-info-contact-idioma" class="show-info-general">{{ $empresa->idioma }}</div>
        </div>
        <div>
            <div>País</div>
            <div id="show-info-contact-pais" class="show-info-general">{{ $empresa->pais }}</div>
        </div>
    </div>
</div>
@endsection

@section('modals')

    @include('admin.company.partials.modal-update-company')
    @include('partials.loader')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/core-company.js') }}"></script>
@endsection