<?php

namespace App\Http\Controllers\Admin\Tienda;

use App\Empresa;
use App\Facades\Core;
use App\Tienda;
use App\UsuarioEmpleadoInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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

            if (Core::existTiendaRoute($request['store_route']) === 0)
            {
                $tienda = new Tienda();
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

                return response()->json([
                    'tienda' => $tienda
                ]);
            }

            return response()->json([
                'message' => 'La ruta ya existe, por favor elige otra.'
            ]);

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

            $tienda = Tienda::findOrFail($request['id']);

            return response()->json([
               'tienda' => $tienda
            ]);
        }
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

            return response()->json([
                'tienda' => $tienda
            ]);
        }
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
        $productos = Core::getAllProductosByTiendaRoute($tiendaRoute, '1');

        if ($tienda->store_route_platilla == 'basic') {
            return view('plantillas.basic.index', compact('tienda', 'userContacto', 'userPerfil', 'productos'));
        }

    }


    public function verTiendaInfo($tiendaRoute) {

        Core::isTiendaRouteValid( $tiendaRoute );

        if (!Auth::guest()) {
            $userContacto = Core::getUserContact();
            $userPerfil = Core::getUserPerfil();
        }

        $tienda = Tienda::where('store_route', $tiendaRoute)->first();

        if ($tienda->store_route_platilla == 'basic') {
            return view('plantillas.basic.info-plantilla', compact('tienda', 'userContacto', 'userPerfil'));
        }

    }
}
