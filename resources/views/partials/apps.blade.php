<!-- Apps -->
<div class="core-apps-background-a"></div>
<div class="core-apps-container">
    <a href="{{ route('contacts', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/contacts.svg')}}" />
            </div>
            <a href="">Contacts</a>
        </div>
    </a>
    <a href="{{ route('events', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="">Eventos</a>
        </div>
    </a>
    <a href="{{ route('notes', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="">Notas</a>
        </div>
    </a>
    <a href="{{ route('products', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="">Productos</a>
        </div>
    </a>
    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="#">Name App</a>
        </div>
    </a>
    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="#">Name App</a>
        </div>
    </a>
    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="#">Name App</a>
        </div>
    </a>
    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <a href="#">Name App</a>
        </div>
    </a>
</div>
<!-- End Apps -->