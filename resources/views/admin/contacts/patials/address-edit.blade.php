<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Editar</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Direcciòn Contacto</div>
    </div>

        {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-address-to-update']) !!}
            {!! Form::hidden('option', '2', ['id' => 'option-contact-to-update']) !!}
            {!! Form::hidden('contacto_id', 'null', ['id' => 'contactId-contactAddress-to-update']) !!}

            <div class="container-list-something form-group" id="core-content-form-address">
                <!-- Se agrega los campos correspondientes de la direccion -->
            </div>
        {!! Form::close() !!}

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-address" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-update-address" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar</button>
    </div>
</div>