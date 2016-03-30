<?php

namespace App\Http\Controllers\Admin\Products;

use App\EmpresaHasProducto;
use App\Facades\Core;
use App\ImgProduct;
use App\Producto;
use App\ProductoHasCategoria;
use App\TiendaHasProducto;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

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
        $products  = Core::getAllProductosByIdTienda($idTienda);




        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('events', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        return view('admin.products.products',
            compact('products', 'perfil', 'contacto', 'userPerfil', 'userContacto','fabricantesList','ofertasList','categoriasList', 'idEmpresa', 'idTienda'));
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
    public function store(Request $request )
    {
        if ($request->ajax()) {

            $filePhotoProduct = $request->file('img');
            $namePhotoProduct = 'product-'.\Auth::user()->id . Carbon::now()->second . $filePhotoProduct->getClientOriginalName();
            \Storage::disk('photo_product')->put($namePhotoProduct, \File::get($filePhotoProduct));

            /*
            $producto = new Producto([
                'codigo_producto'       => $request['codigo_producto'],
                'cantidad_disponible'   => $request['cantidad_disponible'],
                'nombre'                => $request['nombre'],
                'precio'                => $request['precio'],
                'desc_producto'         => $request['desc_producto'],
                'estado'                => $request['estado'],
                'fabricante_id'         => $request['fabricante_id'],
                'oferta_id'             => $request['oferta_id'],
                'users_id'              => \Auth::user()->id
            ]);
            */

            $producto = new Producto();
            $producto->fill($request->all());
            $producto->users_id = \Auth::user()->id;
            $producto->save();

            $photoProducto = new ImgProduct([
                'img'           =>  $namePhotoProduct,
                'producto_id'   =>  $producto->id,
                'principal'     =>  '1'
            ]);
            $photoProducto->save();

            $empresa_has_producto = new EmpresaHasProducto(
                [
                    //$empresa = Empresa::where('users_id', \Auth::user()->id)->first(),
                    'empresa_id'    =>  $request['empresa_id'],
                    'producto_id'   =>  $producto->id
                ]
            );
            $empresa_has_producto->save();


            $tienda_has_producto= new TiendaHasProducto(
                [
                    'tienda_id'    =>  $request['tienda_id'],
                    'producto_id'   =>  $producto->id
                ]
            );
            $tienda_has_producto->save();

            $producto_has_categoria  = new ProductoHasCategoria(
                [
                    'categoria_id'    =>  $request['categoria'],
                    'producto_id'   =>  $producto->id
                ]
            );
            $producto_has_categoria->save();

            if (  $producto->save() && $photoProducto  && $empresa_has_producto &&$tienda_has_producto->save() &&  $producto_has_categoria)
                $message = 'Producto agregado.';
            else
                $message = 'No se pudo agregar el producto.';

            // Obtener nombre y ruta de la foto del producto
            $photoProducto->img = URL::to('/') . '/media/photo-product/' . $photoProducto->img;

            return response()->json([
                'message'               => $message,
                'producto'              => $producto,
                'photoProducto'         => $photoProducto,
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
    public function show(Request $request)
    {
        if ( $request->ajax() ) {

            $producto = Producto::findOrFail($request['id']);

            return response()->json([
                'producto' => $producto
            ]);
        }
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
