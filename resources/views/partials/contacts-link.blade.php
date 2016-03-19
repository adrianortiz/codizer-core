<!-- Title menu -->
<a href="{{ route('contacts', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Contactos <span>{{ count($friends) }}</span></div></a>

<!-- list menu with img -->
@forelse($friends as $friend)
    <a href="#" class="core-menu-list menu-list-option menu-lis-img">
        <img src="{{ asset('/media/photo-perfil/' . $friend -> foto) }}">
        <div class="list-contact-full-name">{{ $friend -> nombre. ' ' .$friend -> ap_paterno }}</div>
    </a>
@empty
    <div class="list-contact-full-name">No hay contactos.</div>
@endforelse