@extends('layout-core')

@section('title', 'Empresa / Equipo')

@section('title-header', 'Empresa / Equipo')


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


    <!-- <div class="block-content-info"></div> -->

    <div class="container-list-something">

        <div id="show-info-contact-empresa" class="core-show-sub-title">Empleados de la Empresa</div>
        <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $empresa->nombre }}</div>

        <div class="container-company-store-logo-line">
            <button type="button" id="btn-modal-create-tienda" class="btn btn-primary btn-sm btn-sm-radius right-btn-company" data-toggle="modal" data-target="#modalNewEmployee">Nuevo empleado</button>
        </div>

    </div>




    <div class="container-list-info-admin">
        <div id="container-employees-list-all" class="container-admin-100">


            @if( count($empleados) == 0)
                <div id="msg-vacio">Aun no hay empleados.</div>
            @else

                @foreach( $empleados as $empleado )
                    <div class="employee-container-mini" data-id="{{ $empleado->empleado_id  }}">
                        <div class="btn-employee-container">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-morado-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h fa-lg"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-update-employee" href="#" data-toggle="modal" data-target="#modalUpdateEmployee">Editar Empleado</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-nivel">
                            <span class="txt-color-morado">Nivel</span>
                            <div>{{ $empleado->nivel }}</div>
                        </div>

                        <img src="{{ asset('/media/photo-perfil/' . $empleado->foto) }}" class="body-photo-employee">

                        <div class="body-name-employee">
                            <span class="txt-color-morado">Empleado</span>
                            <div><a href="{{ route('perfil', $empleado->perfil_route) }}" target="_blank">{{ $empleado->nombre . ' ' . $empleado->ap_paterno . ' ' . $empleado->ap_materno }}</a></div>
                        </div>

                        <div class="body-tienda-employee">
                            <span class="txt-color-morado">Tienda</span>
                            <div><a href="{{ route('store.front', $empleado->store_route) }}" target="_blank">{{ $empleado->nombre_tienda }}</a></div>
                        </div>

                        <img src="{{ asset('/media/photo-store/' . $empleado->foto_tienda) }}" class="body-photo-tienda-employee">

                    </div>
                @endforeach

            @endif

        </div>
    </div>


</div>
@endsection

@section('modals')

    @include('admin.company.partials.modal-employee')
    @include('partials.loader')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/core-employee.js') }}"></script>
@endsection