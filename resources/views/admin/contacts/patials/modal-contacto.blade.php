<!-- MODAL STORE NOTE -->
<div class="modal fade" id="modalNewContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo contacto</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'contact.create', 'method' => 'POST', 'id' => 'form-contact-to-create']) !!}
                <div class="form-group">
                    <label for="name">@lang('validation.attributes.name')</label>
                    {!! Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control']) !!}
                    <label for="paterno">@lang('validation.attributes.paterno')</label>
                    {!! Form::text('paterno', old('paterno'), ['id' => 'paterno', 'class' => 'form-control']) !!}
                    <label for="materno">@lang('validation.attributes.materno')</label>
                    {!! Form::text('materno', old('materno'), ['id' => 'materno', 'class' => 'form-control']) !!}

                    <div class="row">
                    <label class="col-sm-3" for="sexo">sexo</label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default btn-xs">Masculino{!! Form::radio('sexo', 'Masculino', ['id' => 'masculino', 'class' => 'form-control']) !!}</label>
                                <label class="btn btn-default btn-xs">Femenino{!! Form::radio('sexo', 'Femenino', ['id' => 'femenino', 'class' => 'form-control']) !!}</label>
                            </div>
                        </div>
                    </div>

                <label for="fecha">Fecha de nacimiento</label>
                {!! Form::date('fecha', old('fecha'), ['id' => 'f_nacimiento', 'class' => 'form-control']) !!}



                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="new-new-contact" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL UPDATE NOTE -->
<div class="modal fade" id="modalUpdateContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="myModalLabel">Editar nota</h4>
            </div>
            <div class="modal-body">
                <!-- FORMULARIO DE ACTUALIZAR NOTA -->
                {!! Form::open(['route' => 'notes.update', 'method' => 'PUT', 'id' => 'form-note-to-update']) !!}
                <div class="form-group">
                    @include('partials.form')
                </div>
                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="update-actual-note" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- FORMULARIO DE SELECCIÓN NOTA -->
{!! Form::open(['route' => 'notes.show', 'method' => 'GET', 'id' => 'form-note-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-note-to-show']) !!}
{!! Form::close() !!}

<!-- FORMULARIO DE ELIMINAR NOTA -->
{!! Form::open(['route' => 'notes.delete', 'method' => 'DELETE', 'id' => 'form-note-to-delete']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-note-to-delete']) !!}
{!! Form::close() !!}

<!-- FORMULARIO DE BUSCAR NOTAS -->
{!! Form::open(['route' => 'notes.search', 'method' => 'GET', 'id' => 'form-note-to-search']) !!}
{!! Form::close() !!}