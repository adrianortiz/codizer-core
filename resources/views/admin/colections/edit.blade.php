@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')



    <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-complements.svg') }}"></span> <span> > </span> {{ $form->name  }} </h1>
            @include('admin.colections.complements.partials.menu')
        </div>
    </div>


    <div class="container-inputs-list min-top">

        <div id="new-register" class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Editar colección {{ $form->name  }}</h3></div>
            </div>

            @include('partials.errors')
            {!! Form::model($form, ['route' => ['admin.colecciones.update', $form], 'method' => 'PUT']) !!}

                @include('admin.colections.partials.filds')
                <button type="submit" class="btn btn-primary float-izq">@lang('collections.btn_edit_collection')</button>

            {!! Form::close() !!}

            @include('admin.colections.partials.delete')

        </div>


        <div id="new-register-import" class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Menú</h3></div>
            </div>

            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">


                <a class="btn" href="{{ route('form', $form) }}">Nuevo registro</a>
                <a class="btn" href="{{ route('admin.colecciones.form.data.index', $form) }}">Gestionar registros</a>
                <a class="btn" href="{{ route('admin.complements.edit', $form) }}">Complements</a>
                <a class="btn" href="{{ url('/admin/colecciones') }}">Cerrar colección</a>

                <!--
                <button type="button" class="btn btn-default">Nuevo registro</button>
                <button type="button" class="btn btn-default">Gestionar registros</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Complements
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-default">Editar colección</button>
                <button type="button" class="btn btn-default">Ver mis colecciones</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupVerticalDrop2" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupVerticalDrop3" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop3">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div>
            </div>
            -->

        </div>


    </div>

@endsection