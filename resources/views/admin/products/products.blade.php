@extends('layout-core')

@section('title', 'Productos')

@section('title-header', 'Productos')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    <a href="#" class="core-menu-list"><div>Empresa</div></a>

    <a href="#" class="core-menu-list menu-list-option menu-lis-img">
        <img src="{{ asset('/media/photo-store/chanel-123.png') }}">
        <div>Chanel</div>
    </a>

    <a href="#" class="core-menu-list"><div>Productos <span>234</span></div></a>

    <a href="#" class="core-menu-list"><div>Categorias <span>3</span></div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Bolso</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Piel</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Critales</div></a>

@endsection


@section('article-content')

@section('extra-content')
    <div class="options-tools-list">
        <div class="left-content-list-tool">
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default btn-sm">1</button>
                <button type="button" class="btn btn-default btn-sm">2</button>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="right-content-list-tool">

            <div id="btn-group-to-product" class="btn-group" role="group" aria-label="...">
                <button type="button" id="btn-edit-product" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalUpdateProduct">Editar</button>
                <button type="button" id="btn-delete-product" class="btn btn-default btn-sm">Eliminar</button>
            </div>

        </div>
    </div>
@endsection

<div class="left-content-list">
    <table class="table table-hover">
        <tbody id="list-products">

        @for($i = 0; $i<100; $i++)
            <tr class="data-product-tr" data-product="1">
                <td>
                    <img src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                </td>
                <td>
                    <div class="list-product-title">Bolso de mano de piel rosado con cristales</div>
                    <span class="list-product-tags">Bolso - Piel</span><br/>
                    <div class="list-product-pz">300 pz</div>
                    <div class="list-product-price">$2100.00</div>
                </td>
            </tr>
        @endfor

        </tbody>
    </table>
</div>

<div id="continaer-product-shows" class="right-content-list">
    <!-- <div id="msg-vacio">Ningún producto seleccionado</div> -->
    <div class="block-content-info-product">

        <div class="container-show-info-product-a">
            <div id="show-info-product-marca">Chanel</div>
            <div id="show-info-product-title">Bolso de mano de piel rosado</div>

            <div class="container-show-info-product-img-b">
                <img id="principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                <img id="show-info-product-img-1" class="sub-image-product principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                <img id="show-info-product-img-2" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                <img id="show-info-product-img-3" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                <img id="show-info-product-img-4" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
            </div>

            <div class="container-show-info-product-list-c">
                <div>
                    <div>Precio</div>
                    <div id="show-info-product-price">$2100.00</div>
                </div>
                <div>
                    <div>Cantidad</div>
                    <div id="show-info-product-cantidad">300 pz</div>
                </div>
                <div>
                    <div>Me gusta</div>
                    <div id="show-info-product-me-gusta">603</div>
                </div>
                <div>
                    <div>Categorias</div>
                    <div id="show-info-product-categorias">
                        <span class="list-product-tags">Bolso</span>
                        <span class="list-product-tags">Piel</span>
                        <span class="list-product-tags">Cafe</span>
                        <span class="list-product-tags">Chanel</span>
                    </div>
                </div>
            </div>

        </div>

        <div id="description-text-title">Descripción</div>
        <div id="show-info-product-desc">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</p>
        </div>

    </div>
</div>
@endsection

@section('modals')

   <!-- Aqui vas tus modals para los formularios -->

@endsection

@section('extra-js')
    <!-- Aqui vas tus js para peticiones Ajax -->
@endsection