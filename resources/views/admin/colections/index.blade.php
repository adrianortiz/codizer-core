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
                <h1><span><img src="{{ asset('/images/icon-complements.svg') }}"></span> <span> > </span> Colecciones de datos</h1>
            </div>

            <div>
                <p>Tienes <span class="badge">{{ $forms->total() }}</span> colecciones</p>
            </div>

        </div>

        <div class="container-inputs-list" id="datos">

            <div class="collection-list-new">
                <div class="collection-new-text">
                    <p>Nueva colección</p>
                </div>
                <div class="collection-new-icon">
                    <a href="{{ route('admin.colecciones.create') }}"><div></div></a>
                </div>
            </div>

            @foreach($forms as $form)
            <div class="collection-list" data-id="{{ $form->id }}">
                <div class="collection-litle">
                    <p>{{ $form->name }}</p>
                </div>
                <div class="collection-info">
                    <p>{{ $form->description }}</p>
                </div>
                <div class="collection-menu">
                    <ul>
                        <li><a href="{{ route('admin.colecciones.edit', $form) }}">Abrir</a></li>
                        <li><a href="#!" class="btn-eliminar">Eliminar</a></li>
                    </ul>
                </div>
            </div>
            @endforeach

            <div class="listar-data">
                {!! $forms->render() !!}
            </div>
        </div>

    {!! Form::open(['route' => ['admin.colecciones.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="{{ asset('/js/collections.js') }}"></script>
@endsection