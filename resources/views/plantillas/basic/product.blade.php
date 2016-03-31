@extends('plantillas.basic.layout-plantilla-basic')

@section('cotent')

    <section class="container-products">
        <article>
            <div class="block-content-info-product">

                <div class="container-show-info-product-a">

                    <div id="show-info-product-marca">Producto</div>
                    <div id="show-info-product-title">{{ $product->nombre }}</div>

                    <div id="show-info-product-img" class="container-show-info-product-img-b">
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
                            <div class="show-info-product show-final-price">$ {{ $finalPrice }}</div>
                        </div>

                        {!! Form::open(['route' => 'store.front.product.orden.store', 'method' => 'POST', 'id' => 'form-tienda-store']) !!}
                        <div>
                            <div>{!! Form::label('nombre', 'Cantidad') !!}</div>
                            <div class="show-info-product">
                                {!! Form::number('cantidad', '1',
                                ['id' => 'cantidad', 'class'=> 'form-control', 'placeholder' => 'Piezas']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <div>
                            <div class="show-info-product">
                                <button type="button" class="btn btn-sm btn-border-yellow">Añadir al carrito</button>
                            </div>
                        </div>

                        <div>
                            <div>Categorias</div>
                            <div id="show-info-product-categorias" class="show-info-product">
                                @forelse($productCategories as $categoria)
                                    <span class="list-product-tags">{{ $categoria->nombre }}</span>
                                @empty
                                    <p>No tiene categorias</p>
                                @endforelse
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