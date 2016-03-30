@extends('plantillas.basic.layout-plantilla-basic')

@section('cotent')

    <section class="container-products">
        <article>
            <div class="block-content-info-product">

                <div class="container-show-info-product-a">

                    <div id="show-info-product-marca">Producto</div>
                    <div id="show-info-product-title">{{ $product->nombre }}</div>

                    <div class="container-show-info-product-img-b">
                        <!-- USA UN FOR PARA IMPRIMIR LAS FOTOS DE CADA PRODUCTO -->
                        <img id="principal-image-product" src="{{ asset('/media/photo-product/' . $product->img ) }}">

                        @foreach($imgsProduct as $imgProduct)
                            <img class="sub-image-product" src="{{ asset('/media/photo-product/' . $imgProduct->img ) }}">
                        @endforeach
                    </div>

                    <div class="container-show-info-product-list-c">

                        <div>
                            <div>Código</div>
                            <div class="show-info-product">{{ $product->codigo_producto }}</div>
                        </div>

                        <div>
                            <div>Fabricante</div>
                            <div class="show-info-product">{{ $product->nombre_fabricante }}</div>
                        </div>

                        <div>
                            <div>Precio y descuento</div>
                            <div class="show-info-product">$ {{ $product->precio }} {{ $product->tipo_oferta . ' ' . $product->regla_porciento }}%</div>
                        </div>

                        <div>
                            <div>Precio final</div>
                            <div class="show-info-product">$ {{ $finalPrice }}</div>
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
                    <p>{{ $product->desc_producto }}</p>
                </div>

            </div>
        </article>
    </section>

@endsection


@section('modals')

@endsection

@section('extra-js')


@endsection