<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">

        <!-- LOS ID EN SU MAYORIA SON PARA QUE IDENTIFIQUES A LOS ELEMENTOS CON JS Y PUEDAS MODIFICAR LA INFORMACIÓN -->

        <div id="show-info-contact-empresa" class="core-show-sub-title">Registro</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Nuevo contacto</div>
    </div>

    <div class="container-show-info-contact-img-b">
        <img id="show-info-contact-foto" src="{{ asset('/media/photo-perfil/unknow.png') }}">
        <a id="show-perfil-contact-link" href="#" class="btn btn-sm-radius btn-shadow-blue">Seleccionar foto</a>
    </div>

    <div class="container-show-info-contact-list-c">
            {!! Form::open(['route' => 'contact.create', 'method' => 'POST', 'id' => 'form-contact-to-create']) !!}
            <div class="form-group">
                <label for="nombre">@lang('validation.attributes.name')</label>
                <div class="show-info-contact">{!! Form::text('nombre', old('nombre'), ['id' => 'name', 'class' => 'form-control']) !!}</div>

                <label for="paterno">@lang('validation.attributes.paterno')</label>
                <div class="show-info-contact">{!! Form::text('paterno', old('paterno'), ['id' => 'paterno', 'class' => 'form-control']) !!}</div>

                <label for="materno">@lang('validation.attributes.materno')</label>
                <div class="show-info-contact">{!! Form::text('materno', old('materno'), ['id' => 'materno', 'class' => 'form-control']) !!}</div>

                    <label for="sexo">sexo</label>
                    <div class="btn-group show-info-contact" id="radio-btns" data-toggle="buttons">
                        <label class="btn btn-default btn-xs active">Masculino{!! Form::radio('sexo', 'Masculino', true, ['id' => 'masculino', 'class' => 'form-control']) !!}</label>
                        <label class="btn btn-default btn-xs">Femenino{!! Form::radio('sexo', 'Femenino', false, ['id' => 'femenino', 'class' => 'form-control']) !!}</label>
                    </div>

                <label for="fecha">Fecha de nacimiento</label>
                <div class="show-info-contact">{!! Form::date('fecha', old('fecha'), ['id' => 'f_nacimiento', 'class' => 'form-control']) !!}</div>

                <label for="profesion">Profesión</label>
                <div class="show-info-contact">{!! Form::text('profesion', old('profesion'), ['id' => 'profesion', 'class' => 'form-control']) !!}</div>

                <label for="estado_civil">Estado civil</label>
                <div class="show-info-contact">{!! Form::text('estado_civil', old('estado_civil'), ['id' => 'estado_civil', 'class' => 'form-control']) !!}</div>

                <label for="estado">Estado</label>
                <div class="show-info-contact">{!! Form::select('estado', ['iniciado' => 'Iniciado', 'completo' => 'Completo'], null, ['placeholder' => 'Selecciona un estado', 'id' => 'estado', 'class' => 'form-control']) !!}</div>

                <label for="desc_contacto">Descripción contacto</label>
                <div class="show-info-contact">{!! Form::text('desc_contacto', old('desc_contacto'), ['id' => 'desc_contacto', 'class' => 'form-control']) !!}</div>

            </div>

            {!! Form::close() !!}
    </div>

    <div id="show-info-contact-desc">
        <button id="btn-cancel-contact" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-save-contact" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Guardar</button>
    </div>
    </div>