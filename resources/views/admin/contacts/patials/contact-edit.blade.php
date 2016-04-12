<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Editar</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Información Contacto</div>
    </div>
        {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-contact-to-update']) !!}
            {!! Form::hidden('option', '1', ['id' => 'option-contact-to-update']) !!}
            {!! Form::hidden('id', 'null', ['id' => 'id-contact-to-update']) !!}

            <div class="container-show-info-contact-img-b">
                    <img name="foto" id="show-info-contact-foto-ud" class="img-rounded btn btn-sm-radius" src="{{ asset('/media/photo-perfil/unknow.png') }}">
                    {!! Form::file('foto', ['accept' => 'image/jpg,image/png', 'id' => 'foto-ud', 'class' => 'form-control form-with-100']) !!}
            </div>

            <div class="container-show-info-contact-list-c">
                <label for="nombre">@lang('validation.attributes.name')</label>
                <div class="show-info-contact">{!! Form::text('nombre', old('nombre'), ['id' => 'nombre-ud', 'class' => 'form-control']) !!}</div>

                <label for="ap_paterno">@lang('validation.attributes.paterno')</label>
                <div class="show-info-contact">{!! Form::text('ap_paterno', old('ap_paterno'), ['id' => 'ap_paterno-ud', 'class' => 'form-control']) !!}</div>

                <label for="ap_materno">@lang('validation.attributes.materno')</label>
                <div class="show-info-contact">{!! Form::text('ap_materno', old('ap_materno'), ['id' => 'ap_materno-ud', 'class' => 'form-control']) !!}</div>

                <label for="sexo">Sexo</label>
                {!! Form::select('sexo', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'], null, ['id' => 'sexo-ud', 'class' => 'form-control']) !!}

                <label for="f_nacimiento">Fecha de nacimiento</label>
                <div class="show-info-contact">{!! Form::date('f_nacimiento', old('f_nacimiento'), ['id' => 'f_nacimiento-ud', 'class' => 'form-control', 'min' => \Carbon\Carbon::createFromDate(null, 1, 1)->subYear(80)->toDateString(), 'max' => \Carbon\Carbon::createFromDate(null, 12, 31)->subYear(18)->toDateString()]) !!}</div>

                <label for="profesion">Profesión</label>
                <div class="show-info-contact">{!! Form::text('profesion', old('profesion'), ['id' => 'profesion-ud', 'class' => 'form-control']) !!}</div>

                <label for="estado_civil">Estado civil</label>
                <div class="show-info-contact">{!! Form::select('estado_civil', ['Soltero' => 'Soltero', 'Casado' => 'Casado'], null, ['id' => 'estado_civil-ud', 'class' => 'form-control']) !!}</div>

                <label for="desc_contacto">Descripción contacto</label>
                <div class="show-info-contact">{!! Form::text('desc_contacto', old('desc_contacto'), ['id' => 'desc_contacto-ud', 'class' => 'form-control']) !!}</div>
            </div>
        {!! Form::close() !!}

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-update" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-update-contact" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar</button>
    </div>
</div>