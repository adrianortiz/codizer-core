<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Editar</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Contacto</div>
    </div>

    <div class="block-content-info-contact">
        {!! Form::open(['route' => 'contact.update', 'method' => 'PUT', 'id' => 'form-contact-to-update']) !!}
            @include('admin.contacts.patials.form-contacts')
        {!! Form::close() !!}
    </div>

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-contact" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-update-contact" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Actualizar</button>
    </div>
</div>