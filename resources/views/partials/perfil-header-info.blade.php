<div id="main-header-info-app-perfil">
    <div id="contact-photo-perfil">

        <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">

        <div class="btn-group-vertical" role="group" aria-label="...">
            <a href="#" id="chat-icon-perfil" class="btn btn-default btn-sm"><i class="fa fa-comment fa-lg fa-flip-horizontal"></i></a>

            <div class="btn-group" role="group">
                <button id="more-icon-perfil" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h fa-lg"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">A</a></li>
                    <li><a href="#">B</a></li>
                    <li><a href="#">C</a></li>
                    <li><a href="#">D</a></li>
                </ul>
            </div>
        </div>

    </div>
    <div id="info-contact-perfil">
        <a href="{{ route('perfil', $perfil[0]->perfil_route) }}">
            <div id="name-perfil">{{ $contacto[0]->nombre . ' ' . $contacto[0]->ap_paterno }}</div>
        </a>
        <a href="{{ route('perfil', $perfil[0]->perfil_route) }}">
            <div id="proffessio-perfil">{{ $contacto[0]->profesion }}</div>
        </a>
    </div>
</div>