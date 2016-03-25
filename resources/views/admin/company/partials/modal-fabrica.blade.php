<!-- MODAL STORE FABRICANTE -->
<div class="modal fade" id="modalNewFabrica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nuevo Fabricante</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'fabrica.store', 'method' => 'POST', 'id' => 'form-fabrica-store']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del fabricante') !!}
                            {!! Form::text('nombre', '', ['id'=>'nombre-fabrica-new', 'placeholder' => 'Nombre del fabricante de productos', 'class' => 'form-control form-with-100 form-group-validate-fabrica val_text_num']) !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-fabrica" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE FABRICANTE -->
<div class="modal fade" id="modalUpdateFabrica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Actualizar Fabricante</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO UPDATE -->
                {!! Form::open(['route' => 'fabrica.update', 'method' => 'PUT', 'id' => 'form-fabrica-update']) !!}

                {!! Form::hidden('id', '', ['id' => 'id-fabrica-show', 'class' => 'form-control form-group-validate-fabrica-update val_num']) !!}

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nuevo nombre de fabricante') !!}
                            {!! Form::text('nombre', '', ['id'=>'nombre-fabrica-show', 'placeholder' => 'Fabricante de productos', 'class' => 'form-control form-with-100 form-group-validate-fabrica-update val_text_num']) !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="update-fabrica" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- FORMULARIO DE SELECCIÓN FABRICANTE -->
{!! Form::open(['route' => 'fabrica.show', 'method' => 'GET', 'id' => 'form-fabrica-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-fabrica-to-show']) !!}
{!! Form::close() !!}