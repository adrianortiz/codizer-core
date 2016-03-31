<?php

namespace App\Http\Controllers\Admin\Orden;

use App\Facades\Core;
use App\OrdenDetalle;
use App\OrdenDetalleGeneral;
use App\Producto;
use App\TiendaHasProducto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( $request->ajax() ) {

            if (\Auth::guest()) {
                return response()->json([
                    'error' => 'Por favor Registrate o Inicia Sesión'
                ]);
            }

            DB::beginTransaction();
            try {

                // Obtener la cantidad disponible del producto
                $cantAvaible = Producto::where('id',$request['id'])->first();

                // Si el pedido es menor a la cantidad disponible se inicia la transacción
                // de lo contrario, se manda un mensaje explicando el motivo
                if ($cantAvaible->cantidad_disponible >= $request['cantidad']) {

                    // Se decrementa la cantidad del producto sobre la cantidad que se pide
                    Producto::where('id', $request['id'])
                        ->decrement('cantidad_disponible', $request['cantidad']);

                    // Se generan los objetos para almacenar los datos del pedido solicitado
                    $tienda = TiendaHasProducto::where('producto_id', $request['id'])->first();
                    $producto = Core::getProductoById( $tienda->tienda_id, $request['id'] );

                    $ordenDetalle = new OrdenDetalle([
                        'producto_id'           => $producto->producto_id,
                        'producto_nombre'       => $producto->nombre,
                        'producto_precio_base'  => $producto->precio,
                        'producto_precio_final' => Core::getFinalPriceByProduct($producto->precio, $producto->tipo_oferta, $producto->regla_porciento),
                        'cantidad'              => $request['cantidad'],
                        'regla_porciento_orden' => $producto->regla_porciento,
                        'tipo_oferta_orden'     => $producto->tipo_oferta
                    ]);
                    $ordenDetalle->save();

                    $ordenDetalleGeneral = new OrdenDetalleGeneral([
                        'orden_detalle_id'  => $ordenDetalle->id,
                        'users_id'          => \Auth::user()->id,
                        'tienda_id'         => $tienda->tienda_id
                    ]);
                    $ordenDetalleGeneral->save();

                    DB::commit();
                    return response()->json([ 'message' => 'Producto añadido a tu carrito.']);

                } else {

                    DB::commit();
                    return response()->json(['message' => 'Por favor disminuya la cantidad del pedido.']);
                }

            } catch (\Exception $e) {

                DB::rollback();
                return response()->json([
                    'error' => 'Sucedio un error, intentalo más tarde.'
                ]);
            }
        }


        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
