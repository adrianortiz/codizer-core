<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\Contacto;
use App\User;
use App\UserHasAgendaContactos;
use App\Facades\Core;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        Core::isRouteValid($nameFirstName);

        // Son los datos del usuario que estás viendo (Perfil)
        $perfil = Core::getPerfil($nameFirstName);
        $contacto = Core::getContact($perfil);
        $userView = User::where('contacto_id', $contacto[0]->id)->first();

        // Son los datos del usuario Logueado
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();
        $user = User::findOrFail(\Auth::user()->id);

        $contacts = Core::getContactos($user->id);
        $friends = Core::getAmigos($userView->id);
        $followers = Core::getFollowers($contacto);

        return view('admin.contacts.friends', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers'));
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

            // Contacto a registrar
            $contact = new Contacto([
                'foto'          => 'unknow.png',
                'nombre'        => $request['nombre'],
                'ap_paterno'    => $request['paterno'],
                'ap_materno'    => $request['materno'],
                'sexo'          => $request['sexo'],
                'f_nacimiento'  => $request['fecha'],
                'profesion'     => $request['profesion'],
                'estado_civil'   => $request['estado_civil'],
                'estado'        => $request['estado'],
                'desc_contacto' => $request['desc_contacto']
            ]);
            $contact -> save();

            // Contacto a guardar en agenda
            $agenda = new UserHasAgendaContactos([
                'users_id'      => \Auth::user()->id,
                'contacto_id'   => $contact->id
            ]);



            if ( $agenda -> save() )
                $message = 'Contacto guardado';
            else
                $message = 'No se pudo guardar el contacto.';

            return response()->json([
                'message' => $message,
                'contacto' => $contact,
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
