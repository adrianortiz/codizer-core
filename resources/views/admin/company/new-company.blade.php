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

    <div id="container-menu-companies">
        <a href="#" class="companies-tag-selectionated">
            <div class="companies-icon"></div>
            <div class="companies-desc">
                <div class="companies-title">Empresa</div>
                <div class="companies-tittle-tag">No hay empresa</div>
            </div>
        </a>
        <a href="#">
            <div class="companies-icon"></div>
            <div class="companies-desc">
                <div class="companies-title">Tiendas</div>
                <div class="companies-tittle-tag">0 Tienda (s)</div>
            </div>
        </a>
        <a href="#">
            <div class="companies-icon"></div>
            <div class="companies-desc">
                <div class="companies-title">Equipo</div>
                <div class="companies-tittle-tag">0 Empleado (s)</div>
            </div>
        </a>
        <a href="#">
            <div class="companies-icon"></div>
            <div class="companies-desc">
                <div class="companies-title">Productos</div>
                <div class="companies-tittle-tag">0 Producto (s)</div>
            </div>
        </a>
    </div>

@endsection

<div id="continaer-note-shows" class="right-content-list content-complete-high">

    <div id="msg-vacio">
        <button type="button" id="btn-new-company" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue" data-toggle="modal" data-target="#modalNewCompany">Nueva Empresa</button>
        <div style="margin-top: 20px;">¡Da de alta tu empresa y comienza a vender!</div>
    </div>

</div>

@endsection

@section('modals')

    @include('admin.company.partials.modal-company')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-company.js') }}"></script>
@endsection