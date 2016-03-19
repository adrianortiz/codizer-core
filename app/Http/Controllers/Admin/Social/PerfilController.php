<?php

namespace App\Http\Controllers\Admin\Social;

use App\Contacto;
use App\Facades\Core;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        Core::isRouteValid($nameFirstName);

        $perfil = Core::getPerfil($nameFirstName);
        $contacto = Core::getContact($perfil);

        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        $friends = Core::getContactos($contacto);

        return view('admin.social.perfil', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'friends'));
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
        //
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

    public function updatePhotoUser(Request $request)
    {
        if ($request->ajax()) {
            // Campo file definido en el formulario
            $file = $request->file('file');

            // Nombre del archivo
            $nombre = 'photo-' .\Auth::user()->id . Carbon::now()->second . $file->getClientOriginalName();

            // Guardar archivo en el disco local
            \Storage::disk('photo')->put($nombre,  \File::get($file));

            // Guardar el nombre de la imagen en el perfil de usuario logueado
            Contacto::where('id', $request['id'])
                ->update(['foto' => $nombre]);

            // Devolver una respuesta JSON que contenga
            // la ruta de la imagen que se acaba de subir
            return response()->json([
                'cover' => URL::to('/') . '/media/photo-perfil/' . $nombre
            ]);
        }
        abort(404);
    }
}
