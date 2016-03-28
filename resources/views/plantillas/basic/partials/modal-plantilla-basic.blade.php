<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <!-- AGREGAR ESTO AL HEADER DE UN MODAL -->
                <div class="container-menu-modal">
                    <div class="modal-tag modal-tag-selectionated">
                        <div class="modal-icon"></div>
                        <div class="modal-desc">
                            <div class="modal-title">Modal</div>
                            <div class="modal-tittle-tag">Información del producto</div>
                        </div>
                    </div>
                </div>
                <button type="hidden" class="close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">

                <div class="block-content-info-product">

                    <div class="container-show-info-product-a">

                        <div id="show-info-product-marca">Chanel</div>
                        <div id="show-info-product-title">Bolso de mano de piel rosado</div>

                        <div class="container-show-info-product-img-b">
                            <!-- USA UN FOR PARA IMPRIMIR LAS FOTOS DE CADA PRODUCTO -->
                            <img id="principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-1" class="sub-image-product principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-2" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel2.png') }}">
                            <img id="show-info-product-img-3" class="sub-image-product" src="{{ asset('/media/photo-product/sudadera-cat.png') }}">
                            <img id="show-info-product-img-4" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                        </div>

                        <div class="container-show-info-product-list-c">
                            <div>
                                <div>Precio</div>
                                <div id="show-info-product-price" class="show-info-product">$2100.00</div>
                            </div>
                            <div>
                                <div>Cantidad</div>
                                <div id="show-info-product-cantidad" class="show-info-product">300 pz</div>
                            </div>
                            <div>
                                <div>Me gusta</div>
                                <div id="show-info-product-me-gusta" class="show-info-product">603</div>
                            </div>
                            <div>
                                <div>Categorias</div>
                                <div id="show-info-product-categorias" class="show-info-product">
                                    <!-- USA UN FOR PARA IMPRIMIR LAS CATEGORIAS A LAS QUE PERTENECE UN PRODUCTO -->
                                    <span class="list-product-tags">Bolso</span>
                                    <span class="list-product-tags">Piel</span>
                                    <span class="list-product-tags">Cafe</span>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <button id="btn-iniciar-compra" type="button" class="btn btn-sm btn-border-yellow">Iniciar compra</button>
            </div>
        </div>
    </div>
</div>