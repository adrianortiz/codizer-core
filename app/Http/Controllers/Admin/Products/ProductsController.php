<?php

namespace App\Http\Controllers\Admin\Products;

use App\EmpresaHasProducto;
use App\Fabricante;
use App\Facades\Core;
use App\Img_product;
use App\Product;
use App\Tienda;
use App\TiendaHasProducto;
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
    public function index($nameFirstName, $idEmpresa, $idTienda)
    {
        /**
         * Con los id $idEmpresa, $idTienda
         * Puedes realizar consultas de la tabla de empres o tienda
         * y obtener su data
         */
        // User son los datos del usuario Logueado
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        $perfil = $userPerfil;
        $contacto = $userContacto;

        // Obtener todos los fabricantes de la empresa N
        $fabricantesList  = Core::getFabricantesByIdEmpresa( $idEmpresa );
        $ofertasList    =   Core::getOfertasByIdEmpresa($idEmpresa);
        $categoriasList =   Core::getCategoriasByIdEmpresa($idEmpresa);

        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('events', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        return view('admin.products.products', compact('perfil', 'contacto', 'userPerfil', 'userContacto','fabricantesList','ofertasList','categoriasList'));
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
    public function store(Request $request , $idEmpresa , $idTienda )

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
            $producto->save();


            $filePhotoProduct = $request->file('logo');
            $namePhotoProduct = 'company-'.\Auth::user()->id . Carbon::now()->second . $filePhotoProduct->getClientOriginalName();
            \Storage::disk('photo_product')->put($namePhotoProduct, \File::get($filePhotoProduct));

            $photoProducto = new Img_product([
                'img'           =>  $namePhotoProduct,
                'producto_id'   =>  $producto->id,
                'principal'     =>  '0'
            ]);
            $photoProducto->save();

            $empresa_has_producto= new EmpresaHasProducto(
                [
                    //$empresa = Empresa::where('users_id', \Auth::user()->id)->first(),
                    'empresa_id'    =>  $idEmpresa->id,
                    'producto_id'   =>  $producto->id
                ]
            );
            $empresa_has_producto->save();


            $tienda_has_producto= new TiendaHasProducto(
                [
                    'tienda_id'    =>  $idTienda->id,
                    'producto_id'   =>  $producto->id
                ]
            );
            $tienda_has_producto->save();

            if ( $tienda_has_producto->save() )
                $message = 'Producto agregado.';
            else
                $message = 'No se pudo agregar el producto.';

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
