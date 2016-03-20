<!-- MODAL STORE NOTE -->
<div class="modal fade" id="modalNewNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title" id="myModalLabel">Nueva nota</h4>
            </div>
            <div class="modal-body">
                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'notes.store', 'method' => 'POST', 'id' => 'form-notes-store']) !!}
                <div class="form-group">

                    {!! Form::label('content', 'Contenido') !!}
                    {!! Form::textarea('content', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Escribe tu nota')) !!}

                </div>
                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-note" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL UPDATE NOTE -->
<div class="modal fade" id="modalUpdateNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

                    {!! Form::hidden('id', 'null', ['id' => 'id-note-to-update']) !!}
                    {!! Form::label('content-note-to-update', 'Contenido') !!}
                    {!! Form::textarea('content', '', array('id' => 'content-note-to-update', 'class'=> 'form-control form-with-100', 'placeholder' => 'Escribe tu nota')) !!}

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