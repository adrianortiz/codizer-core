@extends('layout-core')

@section('title', 'Información')

@section('title-header', 'Información')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

@endsection

@section('article-content')

@section('extra-content')
    <div class="core-tags-container">

        <ul class="nav nav-tabs" data-tabs="tabs">
            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                <li class="active">
                    <a href="#user-info-general" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Cuenta</div>
                        </div>
                    </a>
                </li>
                <li>
            @else
                <li class="active">
                    @endif
                    <a href="#info" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">General</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#dir" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Dirección</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#tel" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Teléfono</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#mail" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Correo</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#social" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Redes sociales</div>
                        </div>
                    </a>
                </li>
        </ul>

    </div>

@endsection

<div class="card-container">

    <div class="tab-content">

        @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
            <div class="form-group tab-pane active" id="user-info-general">
                <div class="container-show-info-contact-a">
                    <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                    <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Cuenta</div>
                </div>

                <div class="container-list-something">

                    <div id="form-edit-user">
                        {!! Form::model($user, ['route' => ['user.update', $user], 'method' => 'POST', 'id' => 'form-user-to-update']) !!}
                        {!! Form::hidden('id', $user->id, ['id' => 'user-id']) !!}

                        <label for="email">@lang('validation.attributes.email')</label>
                        {!! Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control']) !!}

                        <label for="password">@lang('validation.attributes.password')</label>
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}

                        <label for="password_confirmation">@lang('validation.attributes.password_confirmation')</label>
                        {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}

                        {!! Form::close() !!}
                        <div class="container-list-something" id="show-info-contact-desc">
                            <button id="btn-update-user" type="button"
                                    class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                            </button>
                        </div>
                    </div>
                </div>

            </div>


            <div class="form-group tab-pane" id="info">
                @else
                    <div class="form-group tab-pane active" id="info">
                        @endif
                        <div class="container-show-info-contact-a">
                            <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                            <div id="show-info-contact-nombre-completo" class="core-show-title-blue">General</div>
                        </div>

                        <div class="container-list-something" id="core-content-info">

                            <img name="foto" id="show-info-contact-foto" class="img-rounded center-block img-responsive"
                                 src="{{ asset('/media/photo-perfil/' .$contactoInfo[0] -> foto) }}">

                            <div id="show-info-contact-full-nombre"
                                 class="core-show-title-blue text-center">{{ $contactoInfo[0] -> nombre. ' ' .$contactoInfo[0] -> ap_paterno. ' ' .$contactoInfo[0] -> ap_materno }}</div>

                            <div>
                                <div>Sexo</div>
                                <div class="show-info-contact"
                                     id="show-info-contact-sexo">{{ $contactoInfo[0] -> sexo }}</div>
                            </div>

                            <div>
                                <div>Fecha de nacimiento</div>
                                <div id="show-info-contact-f-nacimiento"
                                     class="show-info-contact">{{ \Carbon\Carbon::parse($contactoInfo[0] -> f_nacimiento)->toDateString() }}</div>
                            </div>

                            <div>
                                <div>Profesión</div>
                                <div id="show-info-contact-profesion"
                                     class="show-info-contact">{{ $contactoInfo[0] -> profesion == "" ? "No has ageregado profesión." : $contactoInfo[0] -> profesion }}</div>
                            </div>

                            <div>
                                <div>Estado civil</div>
                                <div id="show-info-contact-estado-civil"
                                     class="show-info-contact">{{ $contactoInfo[0] -> estado_civil }}</div>
                            </div>

                            <div>
                                <div>Descripción</div>
                                <div class="show-info-contact"
                                     id="show-contact-desc-info">{{ $contactoInfo[0] -> desc_contacto == "" ? "No hay descripción." : $contactoInfo[0] -> desc_contacto }}</div>
                            </div>

                            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                                <div class="col-md-12" id="show-info-contact-desc">
                                    <div class="form-group" id="group-edit-address">
                                        <button type="button" id="btn-edit-general"
                                                class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">
                                            Editar Información
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="form-edit" class="core-hidden">
                            {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-contact-to-update']) !!}
                            {!! Form::hidden('option', '1', ['id' => 'option-contactInfo-to-update']) !!}
                            {!! Form::hidden('id', $contactoInfo[0] -> id, ['id' => 'contact-to-update']) !!}

                            <div class="container-show-info-contact-img-b">
                                <img name="foto" id="show-info-contact-foto-ud" class="img-rounded btn btn-sm-radius"
                                     src="{{ asset('/media/photo-perfil/'.$contactoInfo[0] -> foto) }}">
                                {!! Form::file('foto', ['accept' => 'image/jpg,image/png', 'id' => 'foto-ud', 'class' => 'form-control form-with-100']) !!}
                            </div>

                            <div class="container-show-info-contact-list-c">
                                <label for="nombre">@lang('validation.attributes.name')</label>

                                <div class="show-info-contact">{!! Form::text('nombre', $contactoInfo[0] -> nombre, ['id' => 'nombre-ud', 'class' => 'form-control']) !!}</div>

                                <label for="ap_paterno">@lang('validation.attributes.paterno')</label>

                                <div class="show-info-contact">{!! Form::text('ap_paterno', $contactoInfo[0] -> ap_paterno, ['id' => 'ap_paterno-ud', 'class' => 'form-control']) !!}</div>

                                <label for="ap_materno">@lang('validation.attributes.materno')</label>

                                <div class="show-info-contact">{!! Form::text('ap_materno', $contactoInfo[0] -> ap_materno, ['id' => 'ap_materno-ud', 'class' => 'form-control']) !!}</div>

                                <label for="sexo">Sexo</label>
                                {!! Form::select('sexo', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'], $contactoInfo[0] -> sexo, ['id' => 'sexo-ud', 'class' => 'form-control']) !!}

                                <label for="f_nacimiento">Fecha de nacimiento</label>

                                <div class="show-info-contact">
                                    {!! Form::date('f_nacimiento', \Carbon\Carbon::parse($contactoInfo[0] -> f_nacimiento)->toDateString(), ['id' => 'f_nacimiento-ud', 'class' => 'form-control',
                                    'min' => \Carbon\Carbon::createFromDate(null, 1, 1)->subYear(80)->toDateString(),
                                    'max' => \Carbon\Carbon::createFromDate(null, 12, 31)->subYear(18)->toDateString()]) !!}
                                </div>

                                <label for="profesion">Profesión</label>

                                <div class="show-info-contact">{!! Form::text('profesion', $contactoInfo[0] -> profesion, ['id' => 'profesion-ud', 'class' => 'form-control']) !!}</div>

                                <label for="estado_civil">Estado civil</label>

                                <div class="show-info-contact">{!! Form::select('estado_civil', ['Soltero' => 'Soltero', 'Casado' => 'Casado'], $contactoInfo[0] -> estado_civil, ['id' => 'estado_civil-ud', 'class' => 'form-control']) !!}</div>

                                <label for="desc_contacto">Descripción contacto</label>

                                <div class="show-info-contact">{!! Form::text('desc_contacto', $contactoInfo[0] -> desc_contacto, ['id' => 'desc_contacto-ud', 'class' => 'form-control']) !!}</div>
                            </div>
                            {!! Form::close() !!}

                            <div class="container-list-something" id="show-info-contact-desc">
                                <button id="btn-cancel-info" type="button" class="btn btn-default btn-sm btn-sm-radius">
                                    Cancelar
                                </button>
                                <button id="btn-update-contact" type="button"
                                        class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group tab-pane" id="dir">
                        <div class="container-show-info-contact-a">
                            <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                            <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Dirección</div>
                        </div>

                        <div id="core-content-dir" class="container-list-something">
                            <div id="core-content-address">
                                @forelse($contactoAddress as $address)
                                    <div class="show-info-contact">
                                        <div id="show-info-contact-desc-dir">Descripción:
                                            <b> {{ $address -> desc_dir == "" ? "No hay una descripción." : $address -> desc_dir }}</b>
                                        </div>
                                        <div id="show-info-contact-calle">Calle:
                                            <b> {{ $address -> calle == "" ? "No hay calle." : $address -> calle }}</b>
                                        </div>
                                        <div id="show-info-contact-num-dir">Número: <b> {{ $address -> numero_dir }}</b>
                                        </div>
                                        <div id="show-info-contact-p-e">Piso/Edificio:
                                            <b> {{ $address -> piso_edificio }}</b></div>
                                        <div id="show-info-contact-cd">Ciudad:
                                            <b> {{ $address -> ciudad == "" ? "No hay ciudad." : $address -> ciudad }}</b>
                                        </div>
                                        <div id="show-info-contact-cp">Código Postal:
                                            <b> {{ $address -> cp == "" ? "No hay código postal." : $address -> cp }}</b>
                                        </div>
                                        <div id="show-info-contact-edo">Estado:
                                            <b> {{ $address -> estado_dir == "" ? "No hay estado." : $address -> estado_dir }}</b>
                                        </div>
                                        <div id="show-info-contact-pais">País:
                                            <b> {{ $address -> pais == "" ? "No hay país." : $address -> pais }}</b>
                                        </div>
                                    </div>
                                @empty
                                    <div class="show-info-contact">
                                        <div id="show-info-contact-desc-dir">Descripción: <b> No hay una
                                                descripción.</b></div>
                                        <div id="show-info-contact-calle">Calle: <b>No hay calle.</b></div>
                                        <div id="show-info-contact-num-dir">Número: <b> No hay número</b></div>
                                        <div id="show-info-contact-p-e">Piso/Edificio: <b>No hay
                                                piso/edificio</b></div>
                                        <div id="show-info-contact-cd">Ciudad: <b>No hay ciudad.</b></div>
                                        <div id="show-info-contact-cp">Código Postal: <b>No hay código
                                                postal.</b></div>
                                        <div id="show-info-contact-edo">Estado: <b>No hay estado.</b></div>
                                        <div id="show-info-contact-pais">País: <b>No hay país.</b></div>
                                    </div>
                                @endforelse
                            </div>

                            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                                <div class="col-md-12" id="show-info-contact-desc">
                                    <div class="form-group" id="group-edit-address">
                                        <button id="btn-edit-address" type="button"
                                                class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">
                                            Editar Dirección
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="address-edit" class="core-hidden">
                            {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-address-to-update']) !!}
                            {!! Form::hidden('option', '2', ['id' => 'option-contact-to-update']) !!}
                            {!! Form::hidden('contacto_id', $contactoInfo[0]->id, ['id' => 'contactId-contactAddress-to-update']) !!}
                            {!! Form::hidden('num', count($contactoAddress), ['id' => 'nDir']) !!}

                            <div class="container-list-something form-group" id="core-content-form-address">
                                @forelse($contactoAddress as $address)
                                    {!! Form::hidden('id[]', $address->id) !!}
                                    <label for="desc_dir">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_dir[]', $address->desc_dir, ['id' => 'desc_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="calle">Calle</label>
                                    <div class="show-info-contact">{!! Form::text('calle[]', $address->calle, ['id' => 'calle', 'class' => 'form-control']) !!}</div>

                                    <label for="numero_dir">Número</label>
                                    <div class="show-info-contact">{!! Form::text('numero_dir[]', $address->numero_dir, ['id' => 'numero_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="piso_edificio">Piso/Edificio</label>
                                    <div class="show-info-contact">{!! Form::text('piso_edificio[]', $address->piso_edificio, ['id' => 'piso_edificio', 'class' => 'form-control']) !!}</div>

                                    <label for="ciudad">Ciudad</label>
                                    <div class="show-info-contact">{!! Form::text('ciudad[]', $address->ciudad, ['id' => 'ciudad', 'class' => 'form-control']) !!}</div>

                                    <label for="cp">Código Postal</label>
                                    <div class="show-info-contact">{!! Form::text('cp[]', $address->cp, ['id' => 'cp', 'class' => 'form-control']) !!}</div>

                                    <label for="estado_dir">Estado</label>
                                    <div class="show-info-contact">{!! Form::text('estado_dir[]', $address->estado_dir, ['id' => 'estado_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="pais">País</label>
                                    <div class="show-info-contact">{!! Form::text('pais[]', $address->pais, ['id' => 'pais', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @empty
                                    <label for="desc_dir">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_dir[]', old('desc_dir'), ['id' => 'desc_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="calle">Calle</label>
                                    <div class="show-info-contact">{!! Form::text('calle[]', old('calle'), ['id' => 'calle', 'class' => 'form-control']) !!}</div>

                                    <label for="numero_dir">Número</label>
                                    <div class="show-info-contact">{!! Form::text('numero_dir[]', old('numero_dir'), ['id' => 'numero_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="piso_edificio">Piso/Edificio</label>
                                    <div class="show-info-contact">{!! Form::text('piso_edificio[]', old('piso_edificio'), ['id' => 'piso_edificio', 'class' => 'form-control']) !!}</div>

                                    <label for="ciudad">Ciudad</label>
                                    <div class="show-info-contact">{!! Form::text('ciudad[]', old('ciudad'), ['id' => 'ciudad', 'class' => 'form-control']) !!}</div>

                                    <label for="cp">Código Postal</label>
                                    <div class="show-info-contact">{!! Form::text('cp[]', old('cp'), ['id' => 'cp', 'class' => 'form-control']) !!}</div>

                                    <label for="estado_dir">Estado</label>
                                    <div class="show-info-contact">{!! Form::text('estado_dir[]', old('estado_dir'), ['id' => 'estado_dir', 'class' => 'form-control']) !!}</div>

                                    <label for="pais">País</label>
                                    <div class="show-info-contact">{!! Form::text('pais[]', old('pais'), ['id' => 'pais', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @endforelse

                                <div id="codizer-new-address">
                                    <!-- Inputs text for more address -->
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btn-update-new-address" type="button"
                                            class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">+
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <div class="container-list-something" id="show-info-contact-desc">
                                <button id="btn-cancel-address" type="button"
                                        class="btn btn-default btn-sm btn-sm-radius">Cancelar
                                </button>
                                <button id="btn-update-address" type="button"
                                        class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group tab-pane" id="tel">
                        <div class="container-show-info-contact-a">
                            <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                            <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Teléfono</div>
                        </div>

                        <div id="core-content-tel" class="container-list-something">

                            <div id="core-content-phone">
                                @forelse($contactoPhone as $phone)
                                    <div>
                                        <div class="show-info-contact">
                                            <div>
                                                <div>{{ $phone -> desc_tel == "" ? "No hay descripción." : $phone -> desc_tel }}</div>
                                                <div id="show-info-contact-num-tel">{{ $phone -> numero_tel == "" ? "No hay número telefonico." : $phone -> numero_tel}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <div class="show-info-contact">
                                            <div id="show-info-contact-desc-tel">Descripción: <b> No hay una
                                                    descripción.</b></div>
                                            <div id="show-info-contact-num-tel">Numero: <b>No hay número.</b>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                                <div class="col-md-12" id="show-info-contact-desc">
                                    <div class="form-group" id="group-edit-phone">
                                        <button id="btn-edit-phone" type="button"
                                                class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">
                                            Editar Teléfono
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="phone-edit" class="core-hidden">
                            {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-phone-to-update']) !!}
                            {!! Form::hidden('option', '3', ['id' => 'option-contact-to-update']) !!}
                            {!! Form::hidden('contacto_id', $contactoInfo[0]->id, ['id' => 'contactId-contactPhone-to-update']) !!}
                            {!! Form::hidden('num', count($contactoPhone), ['id' => 'nTel']) !!}

                            <div class="container-list-something form-group" id="core-content-form-phone">

                                @forelse($contactoPhone as $phone)
                                    {!! Form::hidden('id[]', $phone->id) !!}
                                    <label for="desc_tel">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_tel[]', $phone->desc_tel, ['id' => 'desc_tel', 'class' => 'form-control']) !!}</div>

                                    <label for="numero_tel">Número</label>
                                    <div class="show-info-contact">{!! Form::text('numero_tel[]', $phone->numero_tel, ['id' => 'numero_tel', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @empty
                                    <label for="desc_tel">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_tel[]', old('desc_tel'), ['id' => 'desc_tel', 'class' => 'form-control']) !!}</div>

                                    <label for="numero_tel">Número</label>
                                    <div class="show-info-contact">{!! Form::text('numero_tel[]', old('numero_tel'), ['id' => 'numero_tel', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @endforelse

                                <div id="codizer-new-phone">
                                    <!-- Inputs text for more phones -->
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btn-update-new-phone" type="button"
                                            class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">+
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <div class="container-list-something" id="show-info-contact-desc">
                                <button id="btn-cancel-phone" type="button"
                                        class="btn btn-default btn-sm btn-sm-radius">Cancelar
                                </button>
                                <button id="btn-update-phone" type="button"
                                        class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group tab-pane" id="mail">
                        <div class="container-show-info-contact-a">
                            <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                            <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Correo</div>
                        </div>

                        <div id="core-content-correo" class="container-list-something">
                            <div id="core-content-mail">
                                @forelse($contactoMail as $mail)
                                    <div>
                                        <div class="show-info-contact">
                                            <div>
                                                <div>{{ $mail -> desc_mail == "" ? "No hay descripción." : $mail -> desc_mail }}</div>
                                                <div id="show-info-contact-mail">{{ $mail -> email == "" ? "No hay corre." : $mail -> email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <div class="show-info-contact">
                                            <div id="show-info-contact-desc-mail">Descripción: <b> No hay una
                                                    descripción.</b></div>
                                            <div id="show-info-contact-mail">Correo: <b>No hay correo.</b>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                                <div class="col-md-12" id="show-info-contact-desc">
                                    <div class="form-group" id="group-edit-mail">
                                        <button id="btn-edit-mail" type="button"
                                                class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">
                                            Editar Correo
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="mail-edit" class="core-hidden">

                            {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-mail-to-update']) !!}
                            {!! Form::hidden('option', '4', ['id' => 'option-contact-to-update']) !!}
                            {!! Form::hidden('contacto_id', $contactoInfo[0]->id, ['id' => 'contactId-contactMail-to-update']) !!}
                            {!! Form::hidden('num', count($contactoMail), ['id' => 'nMail']) !!}

                            <div class="container-list-something form-group" id="core-content-form-mail">
                                @forelse($contactoMail as $mail)
                                    {!! Form::hidden('id[]', $mail->id) !!}
                                    <label for="desc_mail">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_mail[]', $mail->desc_mail, ['id' => 'desc_mail', 'class' => 'form-control']) !!}</div>

                                    <label for="email">Correo</label>
                                    <div class="show-info-contact">{!! Form::text('email[]', $mail->email, ['id' => 'email', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @empty
                                    <label for="desc_mail">Descripción</label>
                                    <div class="show-info-contact">{!! Form::text('desc_mail[]', old('desc_mail'), ['id' => 'desc_mail', 'class' => 'form-control']) !!}</div>

                                    <label for="email">Correo</label>
                                    <div class="show-info-contact">{!! Form::text('email[]', old('email'), ['id' => 'email', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @endforelse


                                <div id="codizer-new-mail">
                                    <!-- Inputs text for more mails -->
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btn-update-new-mail" type="button"
                                            class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">+
                                    </button>
                                </div>
                            </div>

                            {!! Form::close() !!}

                            <div class="container-list-something" id="show-info-contact-desc">
                                <button id="btn-cancel-mail" type="button" class="btn btn-default btn-sm btn-sm-radius">
                                    Cancelar
                                </button>
                                <button id="btn-update-mail" type="button"
                                        class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="form-group tab-pane" id="social">
                        <div class="container-show-info-contact-a">
                            <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                            <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Redes sociales
                            </div>
                        </div>

                        <div id="core-content-social" class="container-list-something">
                            <div id="core-content-social-net">
                                @forelse($contactoSocial as $social)
                                    <div>
                                        <div class="show-info-contact">
                                            <div>
                                                <div>{{ $social -> red_social_nombre == "" ? "No hay red social." : $social -> red_social_nombre }}</div>
                                                <div id="show-info-contact-mail">{{ $social -> url == "" ? "No hay url." : $social -> url }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <div class="show-info-contact">
                                            <div id="show-info-contact-desc-mail">Descripción: <b> No hay una
                                                    descripción.</b></div>
                                            <div id="show-info-contact-mail">Url: <b>No hay url.</b></div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                                <div class="col-md-12" id="show-info-contact-desc">
                                    <div class="form-group" id="group-edit-social">
                                        <button id="btn-edit-social" type="button"
                                                class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">
                                            Editar Redes sociales
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div id="social-edit" class="core-hidden">
                            {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-social-to-update']) !!}
                            {!! Form::hidden('option', '5', ['id' => 'option-contact-to-update']) !!}
                            {!! Form::hidden('contacto_id', $contactoInfo[0]->id, ['id' => 'contactId-contactSocial-to-update']) !!}
                            {!! Form::hidden('num', count($contactoSocial), ['id' => 'nSocial']) !!}

                            <div class="container-list-something form-group" id="core-content-form-social">

                                @forelse($contactoSocial as $social)
                                    {!! Form::hidden('id[]', $social->id) !!}
                                    <label for="red_social_nombre">Red social</label>
                                    <div class="show-info-contact">{!! Form::select('red_social_nombre[]', ['Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Linkedin' => 'Linkedin', 'Google+' => 'Google+', 'Instagram' => 'Instagram'], $social->red_social_nombre, ['id' => 'red_social_nombre', 'class' => 'form-control']) !!}</div>

                                    <label for="url">URL</label>
                                    <div class="show-info-contact">{!! Form::text('url[]', $social->url, ['id' => 'url', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @empty
                                    <label for="red_social_nombre">Red social</label>
                                    <div class="show-info-contact">{!! Form::select('red_social_nombre[]', ['Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Linkedin' => 'Linkedin', 'Google+' => 'Google+', 'Instagram' => 'Instagram'], null, ['id' => 'red_social_nombre', 'class' => 'form-control']) !!}</div>

                                    <label for="url">URL</label>
                                    <div class="show-info-contact">{!! Form::text('url[]', old('url'), ['id' => 'url', 'class' => 'form-control']) !!}</div>
                                    <hr/>
                                @endforelse

                                <div id="codizer-new-social-network">
                                    <!-- Inputs text for more social networks -->
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button id="btn-update-new-social" type="button"
                                            class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">+
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <div class="container-list-something" id="show-info-contact-desc">
                                <button id="btn-cancel-social" type="button"
                                        class="btn btn-default btn-sm btn-sm-radius">Cancelar
                                </button>
                                <button id="btn-update-social" type="button"
                                        class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar
                                </button>
                            </div>
                        </div>
                    </div>

            </div>

    </div>
</div>
@endsection

@section('modals')


@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-acount.js') }}"></script>
@endsection