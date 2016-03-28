<div class="block-content-info-contact">
    <div class="container-show-info-contact-a">
        <div id="show-info-contact-empresa" class="core-show-sub-title">Registro</div>
        <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Nuevo contacto</div>
    </div>

    <div class="block-content-info-contact">
        {!! Form::open(['route' => 'contact.create', 'method' => 'POST', 'id' => 'form-contact-to-create']) !!}
            @include('admin.contacts.patials.form-contacts')
        {!! Form::close() !!}
    </div>

    <div class="container-list-something" id="show-info-contact-desc">
        <button id="btn-cancel-contact" type="button" class="btn btn-default btn-sm btn-sm-radius">Cancelar</button>
        <button id="btn-save-contact" type="button" class="btn btn-primary btn-sm btn-sm-radius btn-shadow-blue right">Guardar</button>
    </div>
</div>