<!-- Search -->
<div class="core-search-container">
    <div class="core-search">

        {!! Form::open(['route' => 'core.searchGlobal', 'method' => 'GET', 'id' => 'form-global-search']) !!}
        {!! Form::text('searh-global', null, ['id' => 'btn-search-ui', 'type' => 'text', 'placeholder' => 'Buscar']) !!}
        <button type="button" id="btn-global-search">OK</button>
        {!! Form::close() !!}

        <button id="btn-close-modal-search"><i class="fa fa-times"></i></button>
    </div>
    <div class="core-search-suggestions">
        <div id="search-suggestions-a">

            <h3>Store</h3>
            <div id="container-store-suggestions">
                <div class="suggestion">
                    <a href="#">
                        <img src="{{ asset('/media/photo-store/chanel-123.png') }}" />
                        <div>
                            <h4>Chanel</h4>
                            <h5>Official Store</h5>
                        </div>
                    </a>
                    <a href="#" class="btn-suggestions-go">Ver</a>
                </div>
            </div>

            <h3>Products</h3>
            <div id="container-product-suggestions">
                <div class="suggestion">
                    <a href="#">
                        <img src="{{ asset('/media/photo-product/sudadera-cat.png') }}" />
                        <div>
                            <h4>White Cat Sudadera</h4>
                            <h5>Hoodies - <span>$690.00</span></h5>
                        </div>
                    </a>
                    <a href="#" class="btn-suggestions-go">Ver</a>
                </div>
            </div>

            <h3>Users</h3>
            <div id="container-user-suggestions">
                <h5>No results</h5>
                <!--
                <div class="suggestion">
                    <a href="#">
                        <img src="{{ asset('/media/photo-perfil/israel-chavarria123.png') }}" />
                        <div>
                            <h4>Karen Olvera</h4>
                            <h5>Costumer at Chanel</h5>
                        </div>
                    </a>
                    <a href="#" class="btn-suggestions-go">Ver</a>
                </div>
                -->

            </div>

        </div>

        <div id="search-suggestions-b">
            <h3>Quick Help</h3>
            <a href="#">Crear tienda</a>
            <a href="#">Ayuda</a>
            <a href="#">Codizer - 2016</a>
        </div>

    </div>

</div>
<!-- End Search -->