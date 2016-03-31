<!-- MODAL STORE EMPLOYEE -->
<div class="modal fade" id="modalNewEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nuevo Empleado</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            @if($countTiendas == 0)
                <div class="modal-body text-center">Para está operación se requiere que des de alta almenos una tienda.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">OK</button>
                </div>
            @else

            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'employee.store', 'method' => 'POST', 'id' => 'form-employee-store']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('option1', 'Selecciona un contacto') !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="container-option-employee-to-select">

                            <div class="btn-group-vertical" data-toggle="buttons" style="width: 100% !important;">

                                @for($i = 0; $i < count($amigosListToEmployee); $i++  )

                                    @if ($i === 0)
                                        <label class="btn form-with-100 option-employee-to-select active">
                                            <input type="radio" id="users_id-employee-new" name="users_id" value="{{ $amigosListToEmployee[$i]->user_id_we }}" autocomplete="off" class="radio-employee-select" checked>
                                            <img src="{{ asset('/media/photo-perfil/' . $amigosListToEmployee[$i]->foto) }}">
                                            <span>{{ $amigosListToEmployee[$i]->nombre . ' ' . $amigosListToEmployee[$i]->ap_paterno . ' ' . $amigosListToEmployee[$i]->ap_materno  }}</span>
                                        </label>
                                    @else
                                        <label class="btn form-with-100 option-employee-to-select">
                                            <input type="radio" id="users_id-employee-new" name="users_id" value="{{ $amigosListToEmployee[$i]->user_id_we }}" autocomplete="off" class="radio-employee-select">
                                            <img src="{{ asset('/media/photo-perfil/' . $amigosListToEmployee[$i]->foto) }}">
                                            <span>{{ $amigosListToEmployee[$i]->nombre . ' ' . $amigosListToEmployee[$i]->ap_paterno . ' ' . $amigosListToEmployee[$i]->ap_materno  }}</span>
                                        </label>
                                    @endif

                                @endfor

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('empresa_id', 'Selecciona una empresa') !!}
                            {!! Form::select('empresa_id', $empresasList, Input::old('empresa_id'),
                            ['id'=>'empresa_id-employee-new', 'class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tienda_id', 'Selecciona una tienda') !!}
                            {!! Form::select('tienda_id', $tiendasList, Input::old('tienda_id'),
                            ['id'=>'tienda_id-employee-new', 'class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nivel', 'Selecciona un nivel de acceso') !!}
                            {!! Form::select('nivel', ['contactos' => 'Contactos', 'mercado' => 'Mercado', 'productos' => 'Productos', 'ordenes' => 'Ordenes', 'empresa' => 'Empresa'], 'empresa',
                            ['id'=>'nivel-employee-new', 'class'=> 'form-control form-with-100 form-group-validate-employee-new val_text'])  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('estado', 'Estado del empleado') !!}
                            {!! Form::select('estado', ['0' => 'Desactivar Empleado', '1' => 'Activar Empleado'], '1',
                            ['id'=>'estado-employee-new', 'class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                            {!! Form::label('salario', 'Salario del empleado (Pesos Mensuales)') !!}
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">$</span>
                                {!! Form::text('salario', '', ['id' => 'salario-employee-show', 'class' => 'form-control form-with-100 form-group-validate-employee-new val_double', 'aria-describedby' => 'basic-addon3', 'placeholder' => '1800.00']) !!}
                            </div>
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="new-employee" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- MODAL UPDATE EMPLOYEE -->
<div class="modal fade" id="modalUpdateEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Actualizar Empleado</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            @if($countTiendas == 0)
                <div class="modal-body text-center">Para está operación se requiere que des de alta almenos una tienda.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">OK</button>
                </div>
            @else

                <div class="modal-body">

                    <!-- FORMULARIO UPDATE -->
                    {!! Form::open(['route' => 'employee.update', 'method' => 'PUT', 'id' => 'form-employee-update']) !!}

                    {!! Form::hidden('id', '', ['id'=>'id', 'class' => 'form-group-validate-employee-update val_num']) !!}

                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('option1', 'Selecciona un contacto') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="container-option-employee-to-select">

                                <div class="btn-group-vertical" data-toggle="buttons" style="width: 100% !important;">

                                    @for($i = 0; $i < count($amigosListToEmployee); $i++  )

                                        @if ($i === 0)
                                            <label class="btn form-with-100 option-employee-to-select active">
                                                <input type="radio" name="users_id" id="users_id" value="{{ $amigosListToEmployee[$i]->user_id_we }}" autocomplete="off" class="radio-employee-select radio-employee-ghange" checked>
                                                <img src="{{ asset('/media/photo-perfil/' . $amigosListToEmployee[$i]->foto) }}">
                                                <span>{{ $amigosListToEmployee[$i]->nombre . ' ' . $amigosListToEmployee[$i]->ap_paterno . ' ' . $amigosListToEmployee[$i]->ap_materno  }}</span>
                                            </label>
                                        @else
                                            <label class="btn form-with-100 option-employee-to-select">
                                                <input type="radio" name="users_id" id="users_id" value="{{ $amigosListToEmployee[$i]->user_id_we }}" autocomplete="off" class="radio-employee-select radio-employee-ghange">
                                                <img src="{{ asset('/media/photo-perfil/' . $amigosListToEmployee[$i]->foto) }}">
                                                <span>{{ $amigosListToEmployee[$i]->nombre . ' ' . $amigosListToEmployee[$i]->ap_paterno . ' ' . $amigosListToEmployee[$i]->ap_materno  }}</span>
                                            </label>
                                        @endif

                                    @endfor

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('empresa_id', 'Selecciona una empresa') !!}
                                {!! Form::select('empresa_id', $empresasList, Input::old('empresa_id'),
                                ['class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('tienda_id', 'Selecciona una tienda') !!}
                                {!! Form::select('tienda_id', $tiendasList, Input::old('tienda_id'),
                                ['class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('nivel', 'Selecciona un nivel de acceso') !!}
                                {!! Form::select('nivel', ['contactos' => 'Contactos', 'mercado' => 'Mercado', 'productos' => 'Productos', 'ordenes' => 'Ordenes', 'empresa' => 'Empresa'], 'empresa',
                                ['class'=> 'form-control form-with-100 form-group-validate-employee-new val_text'])  !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('estado', 'Estado del empleado') !!}
                                {!! Form::select('estado', ['0' => 'Desactivar Empleado', '1' => 'Activar Empleado'], '1',
                                ['class'=> 'form-control form-with-100 form-group-validate-employee-new val_num'])  !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                {!! Form::label('salario', 'Salario del empleado (Pesos Mensuales)') !!}
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                    {!! Form::text('salario', '', [ 'class' => 'form-control form-with-100 form-group-validate-employee-update val_double', 'aria-describedby' => 'basic-addon3', 'placeholder' => '1800.00']) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                    <button id="update-employee" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
                </div>
            @endif
        </div>
    </div>
</div>




<!-- FORMULARIO DE SELECCIÓN EMPLOYEE -->
{!! Form::open(['route' => 'employee.show', 'method' => 'GET', 'id' => 'form-employee-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-employee-to-show']) !!}
{!! Form::close() !!}