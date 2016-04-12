@extends('plantillas.pro.layout-plantilla-pro')

@section('carousel')

    @if( count($productos) >= 3)
    <div class="row carousel-holder">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">

                    @for($i = 0; $i < 3; $i++)

                        @if( $i == 0)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="active"></li>
                        @else
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                        @endif

                    @endfor

                </ol>
                <div class="carousel-inner">

                    @for($i = 0; $i < 3; $i++)

                        @if( $i == 0)
                            <div class="item active" style="height: 340px !important; overflow: hidden !important;">
                                <a href="{{ route('store.front.product.show', [$tienda->store_route, $productos[$i]->producto_id, $productos[$i]->slug]) }}">
                                    <img class="slide-image" src="{{ asset('/media/photo-product/' . $productos[$i]->img) }}" alt="{{ $productos[$i]->nombre }}">
                                </a>
                            </div>
                        @else
                            <div class="item" style="height: 340px !important; overflow: hidden !important;">
                                <a href="{{ route('store.front.product.show', [$tienda->store_route, $productos[$i]->producto_id, $productos[$i]->slug]) }}">
                                    <img class="slide-image" src="{{ asset('/media/photo-product/' . $productos[$i]->img) }}" alt="{{ $productos[$i]->nombre }}">
                                </a>
                            </div>
                        @endif

                    @endfor

                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

    </div>

    @endif
@endsection

@section('cotent')

    @if (session('status'))

        <div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>¡Gracias!</strong> {{ session('status') }}
        </div>

    @endif

    <h3 style="text-align: center">Lo nuevo</h3>

    @foreach( $productos as $producto )
    <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail product-container" data-id="{{ $producto->producto_id }}">
            <img src="{{ asset('/media/photo-product/' . $producto->img) }}" alt="">
            <div class="caption">
                <h5>
                    <a href="{{ route('store.front.product.show', [$tienda->store_route, $producto->producto_id, $producto->slug]) }}">{{ $producto->nombre }}</a>
                </h5>
                <p>Descubre más en:
                    <a href="#" class="btn-preview-product btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a>
                    <a href="{{ route('store.front.product.show', [$tienda->store_route, $producto->producto_id, $producto->slug]) }}" class="btn">Ver más</a></p>
            </div>
            <div class="ratings">
                <p class="pull-right">${{ $producto->precio }} <span>{{ $producto->tipo_oferta .' '.$producto->regla_porciento }}%</span></p>
                <p>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </p>
            </div>
        </div>
    </div>
    @endforeach

@endsection


@section('modals')
    @include('plantillas.pro.partials.modal-plantilla-pro')
@endsection

@section('extra-js')

    <script>
        // $('#btn-view-modal').click();
        $('#tag-home').addClass('menu-selected');
    </script>

@endsection