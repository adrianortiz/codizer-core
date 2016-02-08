@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-complements.svg') }}"></span> <span> > </span> FORMULARIO: {{ $form->name  }}</h1>
            @include('admin.colections.complements.partials.menu')
        </div>
    </div>

    <div class="container-inputs-list min-top">

        <div id="new-register" class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Nuevo registro de {{ $form->name  }}</h3></div>
            </div>

            @if(count($inputs) === 0)

                <p>Aun no generas un formulario, usa > <a href="{{ route('admin.complements.edit', $form) }}">COMPLEMENTS</a></p>

            @else
                {!! Form::open(['route' => ['admin.colecciones.form.data.store', $form], 'method' => 'GET', 'id'=>'save-data']) !!}

                    @foreach($inputs as $input)
                        <div class="form-group">
                            <label for="{{ $input->title }}">{{ $input->title }}</label>
                            {!! Form::text( $input->type_validation . '[]', old('content'), ['id' => $input->title, 'class' => 'form-control form-group-validate ' . $input->type_validation, /*'onkeyup'=>'validacion("'. $input->type_validation .'")',*/ 'title' => $input->description, 'data-toggle' => 'tooltip', 'data-placement' => 'right']) !!}
                            {!! Form::hidden( $input->type_validation . 'x[]', $input->id) !!}
                            {!! Form::hidden( $input->type_validation . 'y[]', $input->title) !!}
                        </div>
                    @endforeach

                <a href="{{ url('/admin/colecciones') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar datos</button>
                <p>* Todos los campos son obligatorios.</p>

                {!! Form::close() !!}

                <!-- <button id="save-data">Validar</button> -->

            @endif

        </div>

        <div id="new-register-import" class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Importar {{ $form->name  }} desde Excel</h3></div>
            </div>

            {!! Form::open(['route' => ['admin.import.all', $form], 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                <label for="doc_excel">Importar documento Excel</label>
                {!! Form::file('file', ['accept'=>'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'required']) !!}
            </div>
            <a href="{{ url('/admin/colecciones') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Importar datos</button>
            {!! Form::close() !!}


        </div>

    </div>


@include('partials.alert-ajax')

@endsection

@include('partials.errors')

@section('scripts')
    <script src="{{ asset('/js/codizer-alert.js') }}"></script>
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/form.js') }}"></script>
@endsection