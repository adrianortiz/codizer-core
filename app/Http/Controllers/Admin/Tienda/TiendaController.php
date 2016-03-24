<?php

namespace App\Http\Controllers\Admin\Tienda;

use App\Empresa;
use App\Facades\Core;
use App\Tienda;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            return view('admin.company.stores', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'tiendas'));
        }

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
        if ($request->ajax() ) {

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
