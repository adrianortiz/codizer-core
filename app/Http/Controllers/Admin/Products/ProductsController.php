<?php

namespace App\Http\Controllers\Admin\Products;

use App\Empresa;
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
use Illuminate\Support\Facades\DB;
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
        $empresa = Core::getEmpresaById($idEmpresa);
        $tienda=Core::getTiendaById($idTienda);




        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('events', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        return view('admin.products.products',
            compact('tienda','empresa','products', 'perfil', 'contacto', 'userPerfil', 'userContacto','fabricantesList','ofertasList','categoriasList', 'idEmpresa', 'idTienda'));
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

            DB::beginTransaction();
            try {

                $producto = new Producto();
                $producto->fill($request->all());
                $producto->users_id = \Auth::user()->id;
                $producto->save();

                for ($i = 0; $i < count($request->file('img')); $i++) {

                    $filePhotoProduct = $request->file('img')[$i];
                    $namePhotoProduct = 'product-' . \Auth::user()->id . Carbon::now()->second . $filePhotoProduct->getClientOriginalName();
                    \Storage::disk('photo_product')->put($namePhotoProduct, \File::get($filePhotoProduct));

                    $photoProducto = new ImgProduct([
                        'img' => $namePhotoProduct,
                        'producto_id' => $producto->id,
                        'principal' => $i == 0 ? '1' : '0'
                    ]);
                    $photoProducto->save();

                }

                $empresa_has_producto = new EmpresaHasProducto([
                    'empresa_id' => $request['empresa_id'],
                    'producto_id' => $producto->id
                ]);
                $empresa_has_producto->save();

                $tienda_has_producto = new TiendaHasProducto([
                    'tienda_id' => $request['tienda_id'],
                    'producto_id' => $producto->id
                ]);
                $tienda_has_producto->save();

                // Save one or more categories
                // foreach ($request['categoria'] as $categoria) {
                for ($i = 0; $i < count($request['categoria']); $i++) {

                    $producto_has_categoria = new ProductoHasCategoria([
                        'categoria_id' => $request['categoria'][$i],
                        'producto_id' => $producto->id
                    ]);
                    $producto_has_categoria->save();
                }

                // Obtener nombre y ruta de la foto del producto
                $photoProducto->img = URL::to('/') . '/media/photo-product/' . $photoProducto->img;

                DB::commit();
                return response()->json([
                    'message' => 'Producto agregado.',
                    'producto' => $producto,
                    'photoProducto' => $photoProducto,
                ]);

            } catch(\Exception $e ) {
                DB::rollback();

                return response()->json([
                    'error' => 'Ocurrio un error.',
                    'case' => $e
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
