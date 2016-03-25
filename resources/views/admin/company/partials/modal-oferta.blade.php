<!-- MODAL STORE OFERTA -->
<div class="modal fade" id="modalNewOferta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nueva Oferta</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'oferta.store', 'method' => 'POST', 'id' => 'form-oferta-store']) !!}

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('regla_porciento', 'Porcentaje en enteros') !!}
                            {!! Form::selectRange('regla_porciento', 0, 1000, 10, array('id'=>'regla_porciento-oferta-new', 'class'=> 'form-control form-with-100 form-group-validate-oferta val_num'))  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tipo_oferta', 'Tipo de oferta (+ o -)') !!}
                            {!! Form::select('tipo_oferta', array('-' => '- Quitar porcentaje al precio', '+' => '+ Agregrar porcentaje al precio'), '-',
                            array('id'=>'tipo_oferta-oferta-new', 'class'=> 'form-control form-with-100'))  !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-oferta" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE OFERTA -->
<div class="modal fade" id="modalUpdateOferta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Actualizar Oferta</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO UPDATE -->
                {!! Form::open(['route' => 'oferta.update', 'method' => 'PUT', 'id' => 'form-oferta-update']) !!}

                {!! Form::hidden('id', '', ['id' => 'id-oferta-show', 'class' => 'form-control form-group-validate-oferta-update val_num']) !!}

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('regla_porciento', 'Nuevo porcentaje en enteros') !!}
                            {!! Form::selectRange('regla_porciento', 0, 1000, 10, array('id'=>'regla_porciento-oferta-show', 'class'=> 'form-control form-with-100 form-group-validate-oferta-update val_num'))  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tipo_oferta', 'Nuevo tipo de oferta (+ o -)') !!}
                            {!! Form::select('tipo_oferta', array('-' => '- Quitar porcentaje al precio', '+' => '+ Agregrar porcentaje al precio'), '-',
                            array('id'=>'tipo_oferta-oferta-show', 'class'=> 'form-control form-with-100'))  !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="update-oferta" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- FORMULARIO DE SELECCIÓN OFERTA -->
{!! Form::open(['route' => 'oferta.show', 'method' => 'GET', 'id' => 'form-oferta-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-oferta-to-show']) !!}
{!! Form::close() !!}