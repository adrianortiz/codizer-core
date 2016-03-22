<!-- MODAL STORE COMPANY -->
<div class="modal fade" id="modalNewCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Nueva Empresa</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <!-- FORMULARIO CREAR -->
                {!! Form::open(['route' => 'companies.store', 'method' => 'POST', 'id' => 'form-company-store']) !!}

                <div class="form-group">
                    {!! Form::file('logo', ['class' => 'form-control form-with-100', 'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('nombre', 'Empresa') !!}
                    {!! Form::text('nombre', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Nombre de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('giro_empresa', 'Giro') !!}
                    {!! Form::text('giro_empresa', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Giro de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sector', 'Sector') !!}
                    {!! Form::text('sector', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Sector de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('rfc', 'RFC') !!}
                    {!! Form::text('rfc', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'RFC')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('direccion', 'Dirección') !!}
                    {!! Form::text('direccion', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Dirección de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('tel', 'Telefono') !!}
                    {!! Form::text('tel', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Telefono de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fax', 'Fax') !!}
                    {!! Form::text('fax', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Fax de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('correo', 'Correo') !!}
                    {!! Form::text('correo', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Correo de la empresa')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pagina_web', 'Página web') !!}
                    {!! Form::text('pagina_web', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'URL')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('idioma', 'Idioma') !!}
                    {!! Form::text('idioma', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'Idioma')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('pais', 'País') !!}
                    {!! Form::text('pais', '', array('class'=> 'form-control form-with-100', 'placeholder' => 'País')) !!}
                </div>

                {!! Form::close() !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="store-new-company" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue">Guardar</button>
            </div>
        </div>
    </div>
</div>