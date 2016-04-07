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

                        <div>Producto</div>
                        <div id="show-info-product-title">-</div>

                        <div id="show-info-product-img" class="container-show-info-product-img-b">
                            <!-- List Product Img here -->
                        </div>

                        <div class="container-show-info-product-list-c">

                            <div>
                                <div>Código</div>
                                <div id="show-info-product-code" class="show-info-product">-</div>
                            </div>

                            <div>
                                <div>Fabricante</div>
                                <div id="show-info-product-fabricante" class="show-info-product">-</div>
                            </div>

                            <div>
                                <div>Precio y descuento</div>
                                <div id="show-info-product-precio-descuento" class="show-info-product">$ - </div>
                            </div>

                            <div>
                                <div>Precio final</div>
                                <div id="show-info-product-final-price" class="show-info-product show-final-price">$0.00</div>
                            </div>

                            {!! Form::open(['route' => 'store.front.product.orden.store', 'method' => 'GET', 'id' => 'form-orden-store']) !!}
                            {!! Form::hidden('id', '', ['id' => 'id_producto_x']) !!}
                            <div>
                                <div>{!! Form::label('nombre', 'Cantidad') !!}</div>
                                <div class="show-info-product">
                                    {!! Form::number('cantidad', '1', ['id' => 'cantidad', 'class'=> 'form-control', 'placeholder' => 'Piezas']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}

                            <div>
                                <div class="show-info-product">
                                    <button id="btn-add-orden-store" type="button" class="btn btn-sm btn-border-yellow">Añadir al carrito</button>
                                </div>
                            </div>

                            <div>
                                <div>Categorias</div>
                                <div id="show-info-product-categorias" class="show-info-product">

                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="description-text-title">Descripción</div>
                    <div id="show-info-product-desc">

                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm btn-sm-radius" data-dismiss="modal">Cancelar</button>
                <a href="{{ route('store.front.product.orden.show', [$tienda->store_route]) }}" id="btn-iniciar-compra" type="button" class="btn btn-sm btn-border-yellow">Ir a mi carrito</a>
            </div>
        </div>
    </div>
</div>



<!-- FORMULARIO DE SELECCIÓN TIENDA -->
{!! Form::open(['route' => 'store.front.product.show.ajax', 'method' => 'GET', 'id' => 'form-product-to-show']) !!}
{!! Form::hidden('id', 'null', ['id' => 'id-product-to-show']) !!}
{!! Form::close() !!}