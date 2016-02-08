@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

        <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-complements.svg') }}"></span> <span> > </span> NUEVA COLECCIÓN </h1>
        </div>
    </div>

    <div class="container-inputs-list min-top">

        <div class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Nueva colección</h3></div>
            </div>

            @include('partials.errors')
            {!! Form::open(['route' => 'admin.colecciones.store', 'method' => 'POST']) !!}

                @include('admin.colections.partials.filds')
                <a href="{{ url('/admin/colecciones') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">@lang('collections.btn_new_collection')</button>

            {!! Form::close() !!}
        </div>

    </div>



@endsection