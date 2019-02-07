<div id="main-header-info-app-perfil">
    <div id="contact-photo-perfil">

        <div id="container-foto-perfil-user">
            @if( $userPerfil[0]->perfil_route == $perfil[0]->perfil_route )
                <!-- Comprobar que el perfil pertenece al usuario logueado -->
                <div id="form-foto-perfil-store">
                    <!-- FORMULARIO CAMBIAR PHOTO PERFIL USER -->
                    <!-- Todo: Agregar parametros correspondientes -->
                    {!! Form::open(['route' => ['contact.photo.store', 'name'], 'method' => 'POST', 'files' => true, 'id' => 'form-foto-to-store', 'class' => 'form-inline']) !!}
                    {!! Form::hidden('id', $userContacto[0]->id) !!}
                    <div class="upload-foto">
                        {!! Form::file('file', ['id' => 'btn-file-foto-store', 'class' => 'form-control', 'required', 'accept' => 'image/jpg,image/png',]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="view-subiendo-foto">
                    <div>
                        <svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><g fill="none" stroke-linecap="round"><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#2C2C2C" stroke-width="10"></path><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#3997ee" stroke-width="4"><animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="502"></animate><animate attributeName="stroke-dasharray" dur="2s" repeatCount="indefinite" values="150.6 100.4;1 250;150.6 100.4"></animate></path></g></svg>
                    </div>
                </div>
            @endif

            <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
        </div>

        <div class="btn-group-vertical" role="group" aria-label="...">
            <a href="#" id="chat-icon-perfil" class="btn btn-default btn-sm"><i class="fa fa-comment fa-lg fa-flip-horizontal"></i></a>

            <div class="btn-group" role="group">
                <button id="more-icon-perfil" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h fa-lg"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twetter</a></li>
                    <li><a href="#">Blog</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Correo</a></li>
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