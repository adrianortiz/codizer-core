<!-- MODAL UPDATE COMPANY -->
<div class="modal fade" id="modalUpdateCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Actualizar Empresa</div>
                        </div>
                    </div>
                </div>

                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- FORMULARIO UPDATE -->
                {!! Form::open(['route' => 'companies.update', 'method' => 'POST', 'files' => true, 'id' => 'form-company-update']) !!}


                {!! Form::hidden('id', $empresa->id, array('id' => 'id', 'class' => 'form-control form-with-100 form-group-validate val_num')) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('logo', 'Foto de la empresa') !!}
                            {!! Form::file('logo', ['accept' => 'image/jpg,image/png', 'class' => 'form-control form-with-100']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Empresa') !!}
                            {!! Form::text('nombre', '', array('id' => 'nombre', 'class'=> 'form-control form-with-100 form-group-validate val_text_num', 'placeholder' => 'Nombre de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('giro_empresa', 'Giro') !!}
                            {!! Form::text('giro_empresa', '', array('id' => 'giro_empresa', 'class'=> 'form-control form-with-100 form-group-validate val_text', 'placeholder' => 'Giro de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sector', 'Sector') !!}
                            {!! Form::select('sector', array('Publico' => 'Publico', 'Privado' => 'Privado'), 'Privado',
                            array('id' => 'sector', 'class'=> 'form-control form-with-100 form-group-validate val_text'))  !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('rfc', 'RFC') !!}
                            {!! Form::text('rfc', '', array('id' => 'rfc', 'class'=> 'form-control form-with-100 form-group-validate val_text_num', 'placeholder' => 'RFC')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('direccion', 'Dirección') !!}
                            {!! Form::text('direccion', '', array('id' => 'direccion', 'class'=> 'form-control form-with-100 form-group-validate val_text_num', 'placeholder' => 'Dirección de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('tel', 'Teléfono') !!}
                            {!! Form::text('tel', '', array('id' => 'tel', 'class'=> 'form-control form-with-100 form-group-validate val_num', 'placeholder' => 'Telefono de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('fax', 'Fax') !!}
                            {!! Form::text('fax', '', array('id' => 'fax', 'class'=> 'form-control form-with-100', 'placeholder' => 'Fax de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('correo', 'Correo') !!}
                            {!! Form::text('correo', '', array('id' => 'correo', 'class'=> 'form-control form-with-100 form-group-validate val_mail', 'placeholder' => 'Correo de la empresa')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pagina_web', 'Página web') !!}
                            {!! Form::text('pagina_web', '', array('id' => 'pagina_web', 'class'=> 'form-control form-with-100', 'placeholder' => 'URL')) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('idioma', 'Idioma') !!}
                            {!! Form::select('idioma', array('Español' => 'Español', 'Inglés' => 'Inglés', 'Francés' => 'Francés', 'Alemán' => 'Alemán', 'Chino Mandarin' => 'Chino Mandarin'), 'Español',
                            array('id' => 'idioma', 'class'=> 'form-control form-with-100 form-group-validate val_text'))  !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pais', 'País') !!}
                            {!! Form::select('pais', array('México' => 'México', 'España' => 'España', 'Estados Unidos' => 'Estados Unidos', 'Francia' => 'Francia', 'Alemania' => 'Alemania', 'China' => 'China'), 'México',
                            array('id' => 'pais', 'class'=> 'form-control form-with-100 form-group-validate val_text'))  !!}
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="update-company" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- FORMULARIO DE SELECCIÓN DE EMPRESA -->
{!! Form::open(['route' => 'companies.show', 'method' => 'GET', 'id' => 'form-company-to-show']) !!}
{!! Form::hidden('id', $empresa->id, ['id' => 'id-company-to-show']) !!}
{!! Form::close() !!}