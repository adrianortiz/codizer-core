<div id="container-menu-companies">
    <a href="{{ route('companies.index', $userPerfil[0]->perfil_route) }}" id="company-tag">
        <div class="companies-icon"></div>
        <div class="companies-desc">
            <div class="companies-title">Empresa</div>
            <div id="show-info-contact-nombre-tag" class="companies-tittle-tag">{{ $empresa->nombre }}</div>
        </div>
    </a>

    <a href="{{ route('stores.index', $userPerfil[0]->perfil_route) }}" id="tienda-tag">
        <div class="companies-icon"></div>
        <div class="companies-desc">
            <div class="companies-title">Tiendas</div>
            <div class="companies-tittle-tag">{{ $countTiendas }} Tienda (s)</div>
        </div>
    </a>

    <a href="#" id="equipo-tag">
        <div class="companies-icon"></div>
        <div class="companies-desc">
            <div class="companies-title">Equipo</div>
            <div class="companies-tittle-tag">10 Empleado (s)</div>
        </div>
    </a>

    <a href="#" id="productos-tag">
        <div class="companies-icon"></div>
        <div class="companies-desc">
            <div class="companies-title">Productos</div>
            <div class="companies-tittle-tag">34 Producto (s)</div>
        </div>
    </a>

</div>
