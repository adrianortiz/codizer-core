<!-- Title menu -->
<a href="{{ route('contacts', $perfil[0]->perfil_route) }}" class="core-menu-list"><div>Contactos <span>10</span></div></a>

<!-- list menu with img -->
<a href="#" class="core-menu-list menu-list-option menu-lis-img">
    <img src="{{ asset('/media/photo-perfil/' . $contacto[0]->foto) }}">
    <div>Alejandro Ortiz</div>
</a>