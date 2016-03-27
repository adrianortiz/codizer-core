<?php

namespace App\Http\Controllers\Admin\Products;

use App\Facades\Core;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {

        // User son los datos del usuario Logueado
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        $perfil = $userPerfil;
        $contacto = $userContacto;

        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('events', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        return view('admin.products.products', compact('perfil', 'contacto', 'userPerfil', 'userContacto'));
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
        if ($request->ajax()) {

            $producto = new Product([

                'codigo_producto'=>$request['codigo_producto'],
                'cantidad_disponible'=>$request['cantidad_disponible'],
                'nombre'=>$request['nombre'],
                'precio'=>$request['precio'],
                'des_producto'=>$request['desc_producto'],
                'estado'=>$request['estado'],
                'fabricante_id'=>$request['fabricante_id'],
                'oferta_id'=>$request['oferta_id'],
                'users_id'=>$request['users_id']
            ]);

            if ( $producto->save() )
                $message = 'Producto añadido.';
            else
                $message = 'No se pudo añadir el producto.';


            return response()->json([
                'message' => $message,
                'producto' => $producto
            ]);
        } else {
            abort(404);
        }
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
