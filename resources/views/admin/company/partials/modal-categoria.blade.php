<!-- MODAL STORE CATEGORIA -->
<div class="modal fade" id="modalNewCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nueva Categoría</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'categoria.store', 'method' => 'POST', 'id' => 'form-categoria-store']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre de la categoría (tag)') !!}
                            {!! Form::text('nombre', '', ['id'=>'nombre-categoria-new', 'placeholder' => 'Ejemplo: Calzado', 'class' => 'form-control form-with-100 form-group-validate-categoria val_text_num']) !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-categoria" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE CATEGORIA -->
<div class="modal fade" id="modalUpdateCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Actualizar Categoría</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO UPDATE -->
                {!! Form::open(['route' => 'categoria.update', 'method' => 'PUT', 'id' => 'form-categoria-update']) !!}

                {!! Form::hidden('id', '', ['id' => 'id-categoria-show', 'class' => 'form-control form-group-validate-categoria-update val_num']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nuevo nombre de la categoría (tag)') !!}
                            {!! Form::text('nombre', '', ['id'=>'nombre-categoria-show', 'placeholder' => 'Ejemplo: Calzado', 'class' => 'form-control form-with-100 form-group-validate-categoria-update val_text_num']) !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="update-categoria" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- FORMULARIO DE SELECCIÓN CATEGORIA -->
{!! Form::open(['route' => 'categoria.show', 'method' => 'GET', 'id' => 'form-categoria-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-categoria-to-show']) !!}
{!! Form::close() !!}