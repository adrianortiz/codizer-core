<?php

namespace App\Http\Controllers\Admin\Car;

use App\Producto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * @Contructor
     *
     * Para saber si existe una sesión de lo
     * contrario, crear una para car
     */
    public function __construct()
    {
        if(!Session::has('car'))
            Session::put('car', array());
    }

    /**
     * Mostrar todos los productos del carrito
     * @return mixed
     */
    public function show()
    {
        $car = Session::get('car');
        $total = $this->total();

        dd($car, number_format($total, 2));

    }


    /**
     * Agregar un producto al carrito
     *
     * @param $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($idProduct)
    {
        $product = Producto::where('id', $idProduct)->first();
        // Peizas
        $product->quantity = 3;

        $car = Session::get('car');
        $car[$product->id] = $product;
        Session::put('car', $car);

        return redirect()->route('store.front.product.orden.show');
    }

    public function update($idProduct, $quantity)
    {
        $product = Producto::where('id', $idProduct)->first();

        $car = Session::get('car');
        $car[$product->id]->quantity = $quantity;
        Session::put('car', $car);
    }

    /**
     * Eliminar un producto del carrito
     *
     * @param $idProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($idProduct)
    {
        $product = Producto::where('id', $idProduct)->first();

        $car = Session::get('car');
        unset($car[$product->id]);
        Session::put('car', $car);

        return redirect()->route('store.front.product.orden.show');
    }

    public function trash()
    {
        Session::forget('car');
    }

    private function total()
    {
        $car = Session::get('car');
        $total = 0;
        foreach( $car as $item ) {
            $total += $item->precio * $item->quantity;
        }

        return $total;
    }
}
