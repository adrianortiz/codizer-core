<?php

namespace App\Http\Controllers\Admin\Tienda;

use App\Empresa;
use App\Facades\Core;
use App\ImgProduct;
use App\Oferta;
use App\Tienda;
use App\TiendaHasProducto;
use App\UsuarioEmpleadoInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();
        $perfil = $userPerfil;
        $contacto = $userContacto;

        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('stores.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        // Saber si el usuario tiene empresa
        $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

        if ($empresa === null) {
            return view('admin.company.new-company', compact('perfil', 'contacto', 'userPerfil', 'userContacto'));

        } else {
            $countTiendas = Tienda::where('empresa_id', $empresa->id)->count();
            $tiendas = Tienda::where('empresa_id', $empresa->id)->get();

            $countEmpleados = UsuarioEmpleadoInfo::where('empresa_id', $empresa->id)->count();
            return view('admin.company.stores', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'tiendas', 'countEmpleados'));
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax() ) {

            $newRoute = Str::slug($request['store_route']);

            if (Core::existTiendaRoute($newRoute) === 0)
            {
                DB::beginTransaction();
                try {
                    $tienda = new Tienda();
                    $tienda->fill($request->all());
                    $tienda->store_route = $newRoute;

                    if ($request->file('foto')) {
                        // Guardar la nueva imagen en el disco
                        $filePhotoTienda = $request->file('foto');
                        $namePhotoTienda = 'store-' . \Auth::user()->id . Carbon::now()->second . $filePhotoTienda->getClientOriginalName();
                        \Storage::disk('photo_store')->put($namePhotoTienda, \File::get($filePhotoTienda));

                        $tienda->foto = $namePhotoTienda;

                        // FALTA ELIMINAR LA VIEJA IMAGEN DEL DISCO DURO
                    }

                    $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

                    $tienda->empresa_id = $empresa->id;
                    $tienda->save();

                    // Obtener nombre y ruta de la foto de la tienda
                    $tienda->foto = URL::to('/') . '/media/photo-store/' . $tienda->foto;
                    $tienda->store_route = URL::to('/') . '/tienda/' . $tienda->store_route;

                    DB::commit();
                    return response()->json([
                        'tienda' => $tienda
                    ]);

                } catch (\Exception $e ) {
                    DB::rollback();

                    return response()->json([
                        'message' => 'Sucedio un error.'
                    ]);

                }
            }

            return response()->json([
                'message' => 'La ruta ya existe, por favor elige otra.'
            ]);

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

            $tienda = Tienda::findOrFail($request['id']);

            return response()->json([
               'tienda' => $tienda
            ]);
        }

        abort(404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax() ) {

            $tienda = Tienda::findOrFail($request['id']);
            $tienda->fill($request->all());

            if ($request->file('foto') )
            {
                // Guardar la nueva imagen en el disco
                $filePhotoTienda = $request->file('foto');
                $namePhotoTienda = 'store-'.\Auth::user()->id . Carbon::now()->second . $filePhotoTienda->getClientOriginalName();
                \Storage::disk('photo_store')->put($namePhotoTienda, \File::get($filePhotoTienda));

                $tienda->foto = $namePhotoTienda;

                // FALTA ELIMINAR LA VIEJA IMAGEN DEL DISCO DURO
            }

            $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

            $tienda->empresa_id = $empresa->id;
            $tienda->save();

            // Obtener nombre y ruta de la foto de la tienda
            $tienda->foto = URL::to('/') . '/media/photo-store/' . $tienda->foto;
            $tienda->store_route = URL::to('/') . '/tienda/' . $tienda->store_route;

            return response()->json([
                'tienda' => $tienda
            ]);
        }

        abort(404);
    }


    /**
     * Este método es para ver la página web de una tienda, sus productos etc
     * También controlamos la plantilla que tendra la tienda
     *
     * @param $tiendaRoute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verTienda($tiendaRoute) {

        Core::isTiendaRouteValid( $tiendaRoute );

        if (!Auth::guest()) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }


        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if( $tienda->estado == 0 ) {
            return view('plantillas.cerrado.index', compact('tienda'));
        } else {

            $productos = Core::getAllProductosByTiendaRoute($tiendaRoute, '1');

            if ($tienda->store_route_platilla == 'basic') {
                return view('plantillas.basic.index', compact('tienda', 'userContacto', 'userPerfil', 'productos'));
            }

        }

    }


    /**
     * Método para mostra la información de la tienda y su empresa
     * Plantilla de la tienda así como validar que la
     * tienda este activa para el publico
     *
     * @param $tiendaRoute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verTiendaInfo($tiendaRoute) {

        Core::isTiendaRouteValid( $tiendaRoute );

        if (!Auth::guest()) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }

        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if( $tienda->estado == 0 ) {
            return view('plantillas.cerrado.index', compact('tienda'));
        } else {
            $empresa = Empresa::where('id', $tienda->empresa_id)->first();

            if ($tienda->store_route_platilla == 'basic') {
                return view('plantillas.basic.info-plantilla', compact('tienda', 'empresa', 'userContacto', 'userPerfil'));
            }
        }


    }

    public function verProductoInfo($tiendaRoute, $idProduct, $slug) {

        Core::isTiendaRouteValid($tiendaRoute);

        if (!Auth::guest() ) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }

        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if( $tienda->estado == 0 ) {
            return view('plantillas.cerrado.index', compact('tienda'));
        } else {

            $product = Core::getProductoById( $tienda->id, $idProduct );
            $imgsProduct = ImgProduct::where('producto_id', $product->product_id)->get();
            $finalPrice = Core::getFinalPriceByProduct($product->precio, $product->tipo_oferta, $product->regla_porciento);
            $productCategories = Core::getCategoriasByIdProduct($product->product_id);

            if ($tienda->store_route_platilla == 'basic') {
                return view('plantillas.basic.product', compact('tienda', 'product', 'imgsProduct', 'finalPrice', 'productCategories', 'userContacto', 'userPerfil'));
            }

        }
    }

    public function verProductoInfoAjax(Request $request) {

        if ($request->ajax() ) {

            $tiendaHasProduct = TiendaHasProducto::where('producto_id', $request['id'])->first();
            $tienda = Tienda::findOrFail($tiendaHasProduct->tienda_id);

            $product = Core::getProductoById( $tienda->id, $request['id'] );
            $imgsProduct = ImgProduct::where('producto_id', $request['id'])->get();
            $finalPrice = Core::getFinalPriceByProduct($product->precio, $product->tipo_oferta, $product->regla_porciento);
            $productCategories = Core::getCategoriasByIdProduct($product->product_id);

            $url = URL::to('/') . '/media/photo-product/';

            return response()->json([
                'product'           => $product,
                'imgsProduct'       => $imgsProduct,
                'finalPrice'        => $finalPrice,
                'productCategories' => $productCategories,
                'url'               => $url
            ]);
        }

        abort(404);
    }
}
