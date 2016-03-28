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

    <section class="title-basic-section">
        <article>
            <h3>Lo nuevo</h3>
        </article>
    </section>

    <section class="container-products">
        <article>

            @for($i = 0; $i < 3; $i++)

                <div class="product-container">
                    <a href="#">
                        <img src="{{ asset('/media/photo-product/sudadera-cat.png') }}">
                    </a>

                    <div class="lo-nuevo-info">
                        <div><a href="#">Ropa para dama asdasdasd asdas dasdadad asdasd asdads</a></div>
                        <div><a href="#">$144.50 <span>-10%</span></a></div>
                        <div><a href="#" id="btn-view-modal" class="btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a> <a href="#" class="btn btn-sm">Agregar al carrito</a></div>
                    </div>
                </div>

            @endfor

        </article>
    </section>


    <section class="title-basic-section">
        <article>
            <h3>Productos</h3>
        </article>
    </section>


    <section class="container-products">
        <article>

            @for($i = 0; $i < 100; $i++)

                <div class="product-container">
                    <a href="#">
                        <img src="{{ asset('/media/photo-product/sudadera-cat.png') }}">
                    </a>

                    <div class="lo-nuevo-info">
                        <div><a href="#">Ropa para dama asdasdasd asdas dasdadad asdasd asdads</a></div>
                        <div><a href="#">$144.50 <span>-10%</span></a></div>
                        <div><a href="#" id="btn-view-modal" class="btn btn-sm" data-toggle="modal" data-target="#modalView">Ver producto</a> <a href="#" class="btn btn-sm">Agregar al carrito</a></div>
                    </div>
                </div>

            @endfor

        </article>
    </section>

@endsection


@section('modals')
    @include('plantillas.basic.partials.modal-plantilla-basic')
@endsection

@section('extra-js')

    <script>
        $('#btn-view-modal').click();
    </script>

@endsection