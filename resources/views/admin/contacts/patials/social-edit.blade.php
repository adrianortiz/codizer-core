<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Editar</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Redes Sociales Contacto</div>
    </div>

    {!! Form::open(['route' => 'contact.update', 'method' => 'POST', 'id' => 'form-social-to-update']) !!}
        {!! Form::hidden('option', '5', ['id' => 'option-contact-to-update']) !!}
        {!! Form::hidden('contacto_id', 'null', ['id' => 'contactId-contactSocial-to-update']) !!}
        <div class="container-list-something form-group" id="core-content-form-social">
            <!-- Se agregan los campos correspondientes del telefono -->
        </div>
    {!! Form::close() !!}

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-social" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-update-social" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar</button>
    </div>
</div>