@extends('layout-core')

@section('title', 'Empresa / Productos')
@section('title-header', 'Empresa / Producto')

@section('extra-css')
    <style>
        .right-btn-company {
            margin-right: 7px;
        }

        #btn-select-tienda {
            background-color: #FFF !important;
            width: 110px !important;
            margin-right: 20px;
            border-bottom: solid 2px #1E74D0 !important;
        }
    </style>
@endsection

@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')
    @include('partials.contacts-link')

@endsection


@section('article-content')

@section('extra-content')
    @include('admin.company.partials.tags')
@endsection

<div id="continaer-note-shows" class="right-content-list content-complete-high">


    <!-- <div class="block-content-info"></div> -->

    <div class="container-list-something">

        <div id="show-info-contact-empresa" class="core-show-sub-title">Productos de la Empresa</div>
        <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $empresa->nombre }}</div>



        <div class="container-company-store-logo-line">

            <a href="" id="ver-product-store" class="btn btn-primary btn-sm btn-sm-radius right-btn-company core-hidden" target="_blank ">Ver en tienda</a>
            <button type="button" id="btn-edit-product" class="btn btn-primary btn-sm btn-sm-radius right-btn-company core-hidden" data-toggle="modal" data-target="#modalUpdateProduct">Editar</button>
            <button type="button" id="btn-new-product" class="btn btn-primary btn-sm btn-sm-radius right-btn-company" data-toggle="modal" data-target="#modalNewProduct">Nuevo producto</button>

            {!! Form::open(['route' => 'product.admin.by.store', 'method' => 'GET', 'id' => 'form-products-to-show-by-store']) !!}
            {!! Form::select('id', $listTiendas, Input::old('id'), ['id' => 'btn-select-tienda', 'class'=> 'right-btn-company'])  !!}
            {!! Form::close() !!}

        </div>

    </div>

    <div class="container-list-info-admin">
        <div id="container-employees-list-all" class="container-admin-100">


            <!-- LIST TABLE PRODUCTS -->
            <div class="left-content-list">
                <table class="table table-hover">
                    <tbody id="list-products">

                    @foreach($products as $product)
                        <tr class="data-product-tr" data-product="{{ $product->producto_id }}">
                            <td>
                                <img src="{{ asset('/media/photo-product/'. $product->img) }}">
                            </td>
                            <td>
                                <div class="list-product-title">{{$product->nombre}}</div>
                                <span class="list-product-tags">Oferta: {{$product->tipo_oferta.$product->regla_porciento.'%' }}</span><br/>
                                <div class="list-product-pz">{{$product->cantidad_disponible}} pz</div>
                                <div class="list-product-price">{{'$'.$product->precio}}</div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- END LIST TABLE PRODUCT -->

            <!-- DESC PRODUCT -->
            <div id="continaer-product-shows" class="right-content-list core-hidden">
                <!-- <div id="msg-vacio">Ningún producto seleccionado</div> -->
                <div class="block-content-info-product">

                    <div class="container-show-info-product-a">

                        <!-- LOS ID EN SU MAYORIA SON PARA QUE IDENTIFIQUES A LOS ELEMENTOS CON JS Y PUEDAS MODIFICAR LA INFORMACIÓN -->

                        <div id="show-info-product-marca">Mi tienda</div>


                        <div id="show-info-product-title"></div>

                        <div id="show-info-product-imgs" class="container-show-info-product-img-b">
                            <!-- USA UN FOR PARA IMPRIMIR LAS FOTOS DE CADA PRODUCTO -->

                            <img id="principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-1" class="sub-image-product principal-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-2" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-3" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">
                            <img id="show-info-product-img-4" class="sub-image-product" src="{{ asset('/media/photo-product/bolso-rosa-chanel.png') }}">

                        </div>

                        <div class="container-show-info-product-list-c">

                            <div>
                                <div>Codigo del producto</div>
                                <div id="show-info-product-codigo" class="show-info-product"></div>
                            </div>

                            <div>
                                <div>Precio</div>
                                <div id="show-info-product-price" class="show-info-product"></div>
                            </div>

                            <div>
                                <div>Cantidad disponible</div>
                                <div id="show-info-product-cantidad" class="show-info-product"></div>
                            </div>


                            <div>
                                <div>Precio final</div>
                                <div id="show-info-product-final-price" class="show-info-product"></div>
                            </div>


                            <div>
                                <div>Categorias</div>
                                <div id="show-info-product-categorias" class="show-info-product">
                                    <!-- USA UN FOR PARA IMPRIMIR LAS CATEGORIAS A LAS QUE PERTENECE UN PRODUCTO -->
                                    <span class="list-product-tags"></span>
                                </div>


                                <div>
                                    <div>Fabricante</div>
                                    <div id="show-info-product-fabricante" class="show-info-product">

                                        <span class="list-product-tags"></span>
                                    </div>
                                </div>


                            </div>
                        </div>



                        <div id="description-text-title">Descripcion del producto</div>
                        <div id="show-info-product-desc">
                        </div>

                    </div>
                </div>
            <!-- END DESC PRODUCT -->


        </div>
    </div>

</div>

{!! Form::open(['route' => 'products.show', 'method' => 'GET', 'id' => 'form-products-to-show']) !!}
{!! Form::hidden('id', 0, array('id' => 'id-product-to-show')) !!}
{!! Form::close() !!}

@endsection

@section('modals')

    @include('partials.loader')
    @include('admin.products.patials.modal-product')
    @include('admin.products.patials.modal-product-update')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/core-products.js') }}"></script>
    <script src="{{ asset('/js/core-products-admin.js') }}"></script>

    <!-- Description Editor -->
    <script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
@endsection