@extends('plantillas.basic.layout-plantilla-basic')

@section('cotent')

    <section class="slider">
        <article>
            <div class="message">
                <div>{{ $tienda->nombre }}</div>
                <div>{{ $tienda->desc }}</div>
            </div>
            <img src="{{ asset('/plantilla/basic/media/cover.jpg') }}">
        </article>
    </section>

    @if( count($productos) == 0)
        <section class="title-basic-section">
            <article>
                <h3>No hay productos</h3>
            </article>
        </section>
    @else

    @if( count($productos) >= 3)

    <section class="title-basic-section">
        <article>
            <h3>Lo nuevo</h3>
        </article>
    </section>

    <section class="container-products">
        <article>

            @for($i = 0; $i < 3; $i++)

                <div class="product-container">
                    <a href="{{ route('store.front.product.show', [$tienda->store_route, $productos[$i]->producto_id]) }}">
                        <img src="{{ asset('/media/photo-product/' . $productos[$i]->img) }}">
                    </a>

                    <div class="lo-nuevo-info">
                        <div><a href="{{ route('store.front.product.show', [$tienda->store_route, $productos[$i]->producto_id]) }}">{{ $productos[$i]->nombre }}</a></div>
                        <div><a href="{{ route('store.front.product.show', [$tienda->store_route, $productos[$i]->producto_id]) }}">${{ $productos[$i]->precio }} <span>{{ $productos[$i]->tipo_oferta .' '.$productos[$i]->regla_porciento }}%</span></a></div>
                        <div>
                            <a href="#" id="btn-view-modal" class="btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a>
                            <a href="#" class="btn btn-sm">Agregar al carrito</a>
                        </div>
                    </div>
                </div>

            @endfor

        </article>
    </section>

    @endif



    <section class="title-basic-section">
        <article>
            <h3>Productos</h3>
        </article>
    </section>


    <section class="container-products">
        <article>

            @foreach( $productos as $producto )

                <div class="product-container">
                    <a href="{{ route('store.front.product.show', [$tienda->store_route, $producto->producto_id]) }}">
                        <img src="{{ asset('/media/photo-product/' . $producto->img) }}">
                    </a>

                    <div class="lo-nuevo-info">
                        <div><a href="{{ route('store.front.product.show', [$tienda->store_route, $producto->producto_id]) }}">{{ $producto->nombre }}</a></div>
                        <div><a href="{{ route('store.front.product.show', [$tienda->store_route, $producto->producto_id]) }}">${{ $producto->precio }} <span>{{ $producto->tipo_oferta .' '.$producto->regla_porciento }}%</span></a></div>
                        <div>
                            <a href="#" id="btn-view-modal" class="btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a>
                            <a href="#" class="btn btn-sm">Agregar al carrito</a>
                        </div>
                    </div>
                </div>

            @endforeach

        </article>
    </section>

    @endif

@endsection


@section('modals')
    @include('plantillas.basic.partials.modal-plantilla-basic')
@endsection

@section('extra-js')

    <script>
        // $('#btn-view-modal').click();
        $('#tag-home').addClass('menu-selected');
    </script>

@endsection