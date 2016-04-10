@extends('layout-core')

@section('title', 'Empresa / Extras')

@section('title-header', 'Empresa / Extras')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')
    @include('partials.contacts-link')

@endsection


@section('article-content')

@section('extra-content')
    @include('admin.company.partials.tags')
@endsection

<div id="continaer-note-shows" class="right-content-list content-complete-high">


    <!-- <div class="block-content-info"></div> -->

    <div class="container-list-something">

        <div id="show-info-contact-empresa" class="core-show-sub-title">Opciones extras de la empresa</div>
        <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $empresa->nombre }}</div>

    </div>


    <div class="container-list-info-admin-extra">
        <div class="container-admin-100">

            <div class="container-admin-100-tittle">
                <div>
                    <button type="button" class="btn-extra-new btn-extra-blanco-bg" data-toggle="modal" data-target="#modalNewOferta">+</button>
                    <span id="lb-count-oferta" class="tag-num txt-color-azul">{{ count($ofertas) }}</span>Oferta (s)
                </div>
                <div>
                    <button type="button" class="btn-extra-new btn-extra-blanco-bg" data-toggle="modal" data-target="#modalNewFabrica">+</button>
                    <span id="lb-count-fabricante" class="tag-num">{{ count($fabricantes) }}</span>Fabricante (s)
                </div>
                <div>
                    <button type="button" class="btn-extra-new btn-extra-blanco-bg" data-toggle="modal" data-target="#modalNewCategoria">+</button>
                    <span id="lb-count-categoria" class="tag-num txt-color-morado">{{ count($categorias) }}</span>Categoria (s)
                </div>
            </div>

            <div id="container-oferta" class="container-admin-100-33">

                @foreach($ofertas as $oferta)
                    <div class="extra-container-mini" data-id="{{ $oferta->id }}">
                        <div class="btn-extra-container">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-azul-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h fa-lg"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-update-oferta" href="#" data-toggle="modal" data-target="#modalUpdateOferta">Editar Oferta</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-extra">
                            <span class="txt-color-azul">Oferta</span>
                            <div>{{ $oferta->tipo_oferta . ' ' . $oferta->regla_porciento }}%</div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div id="container-fabricante" class="container-admin-100-33">

                @foreach($fabricantes as $fabricante)
                    <div class="extra-container-mini" data-id="{{ $fabricante->id }}">
                        <div class="btn-extra-container">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h fa-lg"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-update-fabrica" href="#" data-toggle="modal" data-target="#modalUpdateFabrica">Editar</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-extra">
                            <span>Fabricante</span>
                            <div>{{ $fabricante->nombre }}</div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div id="container-categoria" class="container-admin-100-33">
                @foreach($categorias as $categoria)
                    <div class="extra-container-mini" data-id="{{ $categoria->id }}">
                        <div class="btn-extra-container">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-morado-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h fa-lg"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-update-categoria" href="#" data-toggle="modal" data-target="#modalUpdateCategoria">Editar Categoria</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="body-extra">
                            <span class="txt-color-morado">Categoria</span>
                            <div>{{ $categoria->nombre }}</div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>


</div>
@endsection

@section('modals')

    @include('admin.company.partials.modal-oferta')
    @include('admin.company.partials.modal-fabrica')
    @include('admin.company.partials.modal-categoria')

    @include('partials.loader')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/core-extras.js') }}"></script>
@endsection