<?php

namespace App\Http\Controllers\Admin\Cart;

use App\Facades\Core;
use App\Producto;
use App\Tienda;
use App\TiendaHasProducto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @Contructor
     *
     * Para saber si existe una sesión de lo
     * contrario, crear una para car
     */
    public function __construct()
    {

        foreach (Tienda::all('store_route') as $tienda) {
            if(!Session::has($tienda->store_route))
                Session::put($tienda->store_route, array());
        }

    }

    /**
     * Mostrar todos los productos del carrito
     * @return mixed
     */
    public function show($tiendaRoute)
    {
        $cart = Session::get($tiendaRoute);
        $total = $this->total($tiendaRoute);

        Core::isTiendaRouteValid($tiendaRoute);

        if (!Auth::guest() ) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }

        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if( $tienda->estado == 0 ) {
            return view('plantillas.cerrado.index', compact('tienda'));
        } else {

            if ($tienda->store_route_platilla == 'basic') {
                return view('plantillas.basic.cart', compact('tienda', 'userContacto', 'userPerfil', 'cart', 'total'));
            }

        }

    }


    /**
     * Agregar un producto al carrito
     *
     * @param $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        if ($request->ajax()) {

            $tiendaHasProduct = TiendaHasProducto::where('producto_id', $request['id'])->first();
            $tienda = Tienda::findOrFail($tiendaHasProduct->tienda_id);
            $product = Core::getProductoById( $tienda->id, $request['id'] );

            $cart = Session::get($tienda->store_route);

            if (array_key_exists($product->product_id, $cart))
                $product->quantity = ($cart[$product->product_id]->quantity + $request['cantidad']);
            else
                $product->quantity = $request['cantidad'];

            $product->final_price = Core::getFinalPriceByProduct($product->precio, $product->tipo_oferta, $product->regla_porciento);


            $cart[$product->product_id] = $product;
            Session::put($tienda->store_route, $cart);

            return response()->json([
                'message' => 'Se añadio a su carrito'
            ]);
        }

        abort(404);
    }

    /**
     * Update quantity of exist product cart list
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $tiendaHasProduct = TiendaHasProducto::where('producto_id', $request['id'])->first();
        $tienda = Tienda::findOrFail($tiendaHasProduct->tienda_id);
        $product = Core::getProductoById( $tienda->id, $request['id'] );

        $cart = Session::get($tienda->store_route);
        $cart[$product->product_id]->quantity = $request['cantidad'];
        Session::put($tienda->store_route, $cart);

        return Redirect::back()->with('message','Cantidad del Item actualizado.');
    }

    /**
     * Delete a producto from cart
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $tiendaHasProduct = TiendaHasProducto::where('producto_id', $request['id'])->first();
        $tienda = Tienda::findOrFail($tiendaHasProduct->tienda_id);

        $cart = Session::get($tienda->store_route);
        unset($cart[$request['id']]);
        Session::put($tienda->store_route, $cart);

        return Redirect::back()->with('message','Item eliminado de la lista.');
    }

    /**
     * Elimina el carrito de compra de una sessión
     */
    public function trash(Request $request)
    {
        Session::forget($request->route);
        return Redirect::back()->with('message','Items eliminados de la lista.');
    }

    /**
     * Genera el precio total a pagar, en base a la cantidad
     * de productos en el carrito, su precio y cantidad de
     * los mismos
     *
     * @return int
     */
    private function total($tiendaRoute)
    {
        $cart = Session::get($tiendaRoute);
        $total = 0;
        foreach( $cart as $item ) {
            $total += $item->final_price * $item->quantity;
        }

        return $total;
    }



    public function orderDetail(Request $request, $tiendaRoute)
    {
        if(count(Session::get($tiendaRoute)) <= 0 ) {
            abort(404);
        }

        $pago = $request['pago'];

        $cart = Session::get($tiendaRoute);
        // dd($cart);
        $total = $this->total($tiendaRoute);

        Core::isTiendaRouteValid($tiendaRoute);

        if (!Auth::guest() ) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }

        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if( $tienda->estado == 0 ) {
            return view('plantillas.cerrado.index', compact('tienda'));
        } else {

            if ($tienda->store_route_platilla == 'basic') {
                return view('plantillas.basic.order-detail', compact('tienda', 'userContacto', 'userPerfil', 'cart', 'total', 'pago'));
            }

        }
    }
}
