<!-- Apps -->
<div class="core-apps-background-a">
<div class="core-apps-container">
    <a href="{{ route('contacts', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/notes.png')}}" />
            </div>
            <span>Contacts</span>
        </div>
    </a>
    <a href="{{ route('events', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/events.png')}}" />
            </div>
            <span>Eventos</span>
        </div>
    </a>
    <a href="{{ route('notes', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/contacts.png')}}" />
            </div>
            <span>Notas</span>
        </div>
    </a>
    <a href="{{ route('events', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/data.png')}}" />
            </div>
            <span>Data</span>
        </div>
    </a>
    <a href="{{ route('companies.index', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/store.png')}}" />
            </div>
            <span>Empresa / Tienda</span>
        </div>
    </a>
    <a href="{{ route('products', $userPerfil[0]->perfil_route) }}">
        <div class="app-option">
            <div class="app-icon">
                <img src="{{asset('/media/apps/products.png')}}" />
            </div>
            <span>Productos</span>
        </div>
    </a>

    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <span>Name App</span>
        </div>
    </a>
    <a href="#">
        <div class="app-option">
            <div class="app-icon"></div>
            <span>Name App</span>
        </div>
    </a>
</div>
<!-- End Apps -->
</div>