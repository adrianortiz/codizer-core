@if(Auth::user()->id == $perfil[0]->id)
    <!-- Title menu -->
    <a href="{{ route('contacts', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Contactos <span id="NContacts">{{ count($contacts) }}</span></div></a>
    <!-- list menu with img -->
    @forelse($contacts as $contact)
        <a href="#" class="core-menu-list menu-list-option menu-lis-img">
            <img src="{{ asset('/media/photo-perfil/' . $contact -> foto) }}">
            <div class="list-contact-full-name">{{ $contact -> nombre. ' ' .$contact -> ap_paterno }}</div>
        </a>
    @empty
        <div class="list-contact-full-name">No hay contactos.</div>
    @endforelse
    <a href="{{ route('friends', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Amigos <span>{{ count($friends) }}</span></div></a>
    <a href="{{ route('followers', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Seguidores <span>{{ count($followers) }}</span></div></a>
@else
    <a href="{{ route('friends', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Amigos <span>{{ count($friends) }}</span></div></a>
    <a href="{{ route('followers', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Seguidores <span>{{ count($followers) }}</span></div></a>
@endif