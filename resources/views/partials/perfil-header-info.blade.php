<div id="main-header-info-app-perfil">
    <div id="contact-photo-perfil">

        <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
        <div>
            <a href="#"><div id="chat-icon-perfil"><i class="fa fa-comment fa-lg fa-flip-horizontal"></i></div></a>
            <a href="#"><div id="more-icon-perfil"><i class="fa fa-ellipsis-h fa-lg"></i></div></a>
        </div>
    </div>
    <div id="info-contact-perfil">
        <a href="">
            <div id="name-perfil">{{ $contacto[0]->nombre . ' ' . $contacto[0]->ap_paterno }}</div>
        </a>
        <a href="">
            <div>{{ $contacto[0]->profesion }}</div>
        </a>
    </div>
</div>