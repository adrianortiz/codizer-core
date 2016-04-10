<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Editar</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Correo Contacto</div>
    </div>

    {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-mail-to-update']) !!}
        {!! Form::hidden('option', '4', ['id' => 'option-contact-to-update']) !!}
        {!! Form::hidden('contacto_id', 'null', ['id' => 'contactId-contactMail-to-update']) !!}
        <div class="container-list-something form-group" id="core-content-form-mail">
            <!-- Se agregan los campos correspondientes del correo -->
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <button id="btn-update-new-mail" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">+</button>
            </div>
        </div>

    {!! Form::close() !!}

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-mail" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-update-mail" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar</button>
    </div>
</div>