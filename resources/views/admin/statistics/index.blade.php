@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success">
            <div class="alert-title-success">
                Estado operación
            </div>
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-estadistica.svg') }}"></span> <span> > </span> ESTADÍSTICAS </h1>
            <div class="menu-global-collection">
                <button id="btnCorto" class="btn btn-default" title="Generar estadistica" onclick="showModalInputs('modal-textoCorto');"><span style="margin-right: 10px;"><img src="{{ asset('/images/icon-estadistica.svg') }}"></span>Generar estadística</button>
            </div>
        </div>
    </div>

    <div class="container-inputs-list min-top">

        <div class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Estadísticas</h3></div>
            </div>

            <p>Selecciona los datos de la colección a graficar.</p>

        </div>

    </div>
    <!--
    {!! Form::open(['route' => ['admin.colecciones.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
    -->

    {!! Form::open(['route' => ['statistics.dispersion.puntos.data'], 'method' => 'GET', 'id' => 'form-points-data']) !!}
        {!! Form::hidden('punto1X', '0', ['id'=>'punto1X']) !!}
        {!! Form::hidden('punto1Y', '0', ['id'=>'punto1Y']) !!}

        {!! Form::hidden('punto2X', '0', ['id'=>'punto2X']) !!}
        {!! Form::hidden('punto2Y', '0', ['id'=>'punto2Y']) !!}
    {!! Form::close() !!}


    @include('partials.alert-ajax')

@endsection

@include('admin.statistics.parcials.modal')

@include('admin.statistics.parcials.modal-extra')

@section('scripts')


    <script src="{{ asset('/js/canvas/canvas2image.js') }}"></script>
    <script src="{{ asset('/js/canvas/Blob.js') }}"></script>
    <script src="{{ asset('/js/canvas/canvas-toBlob.js') }}"></script>
    <script src="{{ asset('/js/canvas/html2canvas.js') }}"></script>
    <script src="{{ asset('/js/canvas/filesaver.js') }}"></script>
    <script src="{{ asset('/js/chart.min.js') }}"></script>


    <!--
    <link rel="stylesheet" href="{{ asset('/css/nv.d3.css') }}">

    <script src="{{ asset('/js/d3/d3.min.js') }}"></script>
    <script src="{{ asset('/js/d3/nv.d3.min.js') }}"></script>
    <script src="{{ asset('/js/d3/stream_layers.js') }}"></script>
    -->

    <script src="{{ asset('/js/codizer-alert.js') }}"></script>

    <script src="{{ asset('/js/statistics-extra.js') }}"></script>
    <script src="{{ asset('/js/codizer_charts.js') }}"></script>
    <script src="{{ asset('/js/statistics.js') }}"></script>

@endsection