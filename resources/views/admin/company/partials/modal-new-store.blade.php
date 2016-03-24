<!-- MODAL STORE TIENDA -->
<div class="modal fade" id="modalNewTienda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nueva Tienda</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'stores.store', 'method' => 'POST', 'id' => 'form-tienda-store']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('foto', 'Foto de la tienda') !!}
                            {!! Form::file('foto', ['accept' => 'image/jpg,image/png', 'class' => 'form-control form-with-100 form-group-validate val_img', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre de la tienda') !!}
                            {!! Form::text('nombre', '', array('class'=> 'form-control form-with-100 form-group-validate val_text_num', 'placeholder' => 'Nombre de la tienda')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('desc', 'Descripción') !!}
                            {!! Form::text('desc', '', array('class'=> 'form-control form-with-100 form-group-validate val_text_num', 'placeholder' => 'Describe tu tienda')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('store_route', 'URL de tu tienda') !!}
                            {!! Form::text('store_route', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Ejemplo: tienda-de-ropa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('store_route_platilla', 'Plantilla para tu tienda') !!}
                            {!! Form::select('store_route_platilla', array('basic' => 'Básica', 'pro' => 'Pro'), 'basic',
                            array('class'=> 'form-control form-with-100 form-group-validate val_text'))  !!}
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('estado', 'Estado de la tienda') !!}
                            {!! Form::select('estado', array('1' => 'Disponible para todo el publico', '0' => 'No disponible al publico'), '1',
                            array('class'=> 'form-control form-with-100 form-group-validate val_num'))  !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-tienda" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>