@extends('plantillas.basic.layout-plantilla-basic')

@section('cotent')

    <section class="title-basic-section">
        <article>
            <h3>
                Carrito

                {!! Form::open(['route' => ['store.front.product.orden.trash'], 'method' => 'DELETE', 'class' => 'right']) !!}
                {!! Form::hidden('route', $tienda->store_route) !!}
                <button type="submit" class="btn btn-sm">Vaciar carrito</button>
                {!! Form::close() !!}

                <a href="{{ route('store.front', [$tienda->store_route]) }}" class="btn btn-sm btn-border-yellow right">Seguir comprando</a>

            </h3>

        </article>
    </section>

    <section class="container-products">
        <article>

            @if( count($cart) === 0)
                <div>No hay Items</div>
            @else
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td width="120px"><img src="{{ asset('/media/photo-product/' . $item->img) }}" width="100"/></td>
                            <td style="text-align: left">
                                <ul>
                                    <li class="cd-link">
                                        <a href="{{ route('store.front.product.show', [$tienda->store_route, $item->producto_id, $item->slug]) }}">
                                            {{ $item->nombre }}
                                        </a>
                                    </li>
                                    <li>${{ $item->precio  . ' ' . $item->tipo_oferta. $item->regla_porciento . '%'}}</li>
                                    <li>
                                        {!! Form::open(['route' => 'store.front.product.orden.delete', 'method' => 'DELETE']) !!}
                                        {!! Form::hidden('id', $item->producto_id, ['id' => 'id']) !!}
                                        <button type="submit" class="btn btn-xs btn-danger">Eliminar de la lista</button>
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </td>
                            <td>${{ number_format($item->final_price, 2) }}</td>

                            <td>
                                {!! Form::open(['route' => 'store.front.product.orden.update', 'method' => 'PUT']) !!}
                                {!! Form::hidden('id', $item->producto_id, ['id' => 'id']) !!}
                                {!! Form::number('cantidad', $item->quantity, ['class' => 'form-control btn btn-sm btn-border-yellow'] ) !!}
                                <button type="submit" class="btn btn-border-yellow btn-order-quantity"><i class="fa fa-refresh"></i></button>
                                {!! Form::close() !!}
                            </td>

                            <td>${{ number_format($item->final_price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h3>Total</h3></td>
                            <td><h3>${{ number_format($total, 2) }}</h3></td>
                        </tr>
                </tbody>
            </table>

            @endif

        </article>
    </section>

    @if( !(count($cart) === 0))
    <section class="form-basic-section">
        <article>
            <div class="row col-sm-12" style="text-align: center">
                {!! Form::open(['route' => ['store.front.product.orden.detail', $tienda->store_route], 'method' => 'GET', 'id' => 'form-products-to-show']) !!}
                    <label class="radio-inline"><input type="radio" name="pago" value="1" checked><img src="{{ asset('/media/icon/card-icon.png') }}"></label>
                    <label class="radio-inline"><input type="radio" name="pago" value="2"><img src="{{ asset('/media/icon/paypal-icon.png') }}"></label>
                    <br/>
                    <br/>
                    <button type="submit" class="btn btn-sm btn-border-yellow">Iniciar pago</button>
                {!! Form::close() !!}
            </div>
    </article>
    </section>
    @endif

@endsection


@section('modals')

@endsection

@section('extra-js')
@endsection