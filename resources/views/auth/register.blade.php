@extends('layout')

@section('title', 'Registrate')

@section('msn-boton')
    <p>Si ya tienes una cuenta inicia sesión</p>
    <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
@endsection

@section('content')
<div id="container-panel-right">

    @include('partials/errors')

    <div id="container-form-register">

        <h1>@lang('auth.register_title')</h1>

        {!! Form::open(['route' => ['register'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        @include('partials.form')

        <div class="form-group">
            <div class="checkbox">
                <label class="core-checkbox">
                    {!! Form::checkbox('terms', '1', ['required' => 'required'])  !!}
                    <span>Terminos y condiciones</span>
                </label>
            </div>
        </div>

        <a  href="#" class="btn btn-default" data-toggle="modal" data-target="#reglas">Leer los terminos</a>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @lang('auth.register_button')
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>


<div class="modal fade" id="reglas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog"  role="document" style="z-index: 99999999 !important;">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Terminos y condiciones</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <p>
                Los presentes términos y condiciones (en adelante, las "Términos") regularán el uso y la concesión de licencias por parte de Codizer de los siguientes servicios Codizer Shop.
                COMPLETANDO EL PROCESO DE ACEPTACIÓN ELECTRÓNICA, HACIENDO CLIC EN "REGISTRAR". HACIENDO USO DE ALGUNO DE LOS SERVICIOS O INDICANDO DE CUALQUIER OTRO MODO SU ACEPTACIÓN DE LOS PRESENTES TÉRMINOS, USTED Y TODA PARTE O ENTIDAD EN CUYO NOMBRE ESTÉ HACIENDO USO O HAYA ADQUIRIDO EL SERVICIO (CONJUNTAMENTE REFERIDOS EN ADELANTE COMO “USTED” O “SU”) MANIFIESTAN Y DECLARAN QUE: (I) USTED ESTÁ AUTORIZADO PARA VINCULARSE A SÍ MISMO Y A CUALQUIER OTRA PARTE EN CUYO NOMBRE ESTÁ UTILIZANDO EL SERVICIO Y/O EL SOFTWARE Y (II) USTED CONSIENTE EN OBLIGARSE A LA TOTALIDAD DE LAS PRESENTES CONDICIONES (INCLUYENDO LOS APARTADOS SOBRE EXCLUSIÓN DE GARANTÍA Y LIMITACIÓN DE RESPONSABILIDAD QUE SE CONTIENEN MÁS ADELANTE),
                </p>
                <p>
                Aceptas que tú y soló tú eres responsable de lo que publicas, compartes etc.
                Codizer Shop de deslinda de todo tipo de responsabilidades.
                </p>
            </div>
        </div>
    </div>
</div>

    <script>
        function checkForm(form)
        {
            if(!form.terms.checked) {
            alert("Por favor, acepta los terminos y condiciones.");
            form.terms.focus();
            return false;
        }
            return true;
        }
    </script>
@endsection