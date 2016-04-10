@if(Auth::user()->id == $perfil[0]->id)
        <!-- Title menu -->
        <a href="{{ route('contacts', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Contactos <span id="NContacts">{{ count($contacts) }}</span></div></a>
        <!-- list menu with img -->
        <div id="core-contacts-container">
    @forelse($contacts as $contact)
        <a href="#0" class="core-menu-list menu-list-option menu-lis-img" id="{{ $contact -> id }}">
            <img src="{{ asset('/media/photo-perfil/' . $contact -> foto) }}">
            <div class="list-contact-full-name">{{ $contact -> nombre. ' ' .$contact -> ap_paterno }}</div>
        </a>
    @empty
        <a href="#0" class="core-menu-list menu-list-option"><div>No hay contactos</div></a>
    @endforelse
        </div>

        <a href="{{ route('friends', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Amigos <span>{{ count($friends) }}</span></div></a>
        <a href="{{ route('followers', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Seguidores <span>{{ count($followers) }}</span></div></a>

@else
    <a href="{{ route('friends', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Amigos <span>{{ count($friends) }}</span></div></a>
    <a href="{{ route('followers', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Seguidores <span>{{ count($followers) }}</span></div></a>
@endif
