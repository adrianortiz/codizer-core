<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\ContactAddress;
use App\ContactMail;
use App\Contacto;
use App\ContactPhone;
use App\ContactSocial;
use App\User;
use App\UserHasAgendaContactos;
use App\Facades\Core;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
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

        // User son los datos del usuario Logueado
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        $contacts = Core::getContactos($contacto);
        $friends = Core::getAmigos($contacto);
        $followers = Core::getFollowers($contacto);

        return view('admin.contacts.contacts', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers'));
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
                'ap_paterno'    => $request['ap_paterno'],
                'ap_materno'    => $request['ap_materno'],
                'sexo'          => $request['sexo'],
                'f_nacimiento'  => $request['f_nacimiento'],
                'profesion'     => $request['profesion'],
                'estado_civil'  => $request['estado_civil'],
                'estado'        => 'iniciado',
                'desc_contacto' => $request['desc_contacto']
            ]);
            $contact -> save();

            $contact_dir = new ContactAddress([
                'desc_dir'      => $request['desc_dir'],
                'calle'         => $request['calle'],
                'numero_dir'    => $request['numero_dir'],
                'piso_edificio' => $request['piso_edificio'],
                'ciudad'        => $request['ciudad'],
                'cp'            => $request['cp'],
                'estado_dir'    => $request['estado_dir'],
                'pais'          => $request['pais'],
                'contacto_id'   => $contact->id
            ]);
            $contact_dir -> save();

            $contact_mail = new ContactMail([
                'desc_mail'     => $request['desc_mail'],
                'email'         => $request['email'],
                'contacto_id'   => $contact->id
            ]);
            $contact_mail -> save();

            $contact_tel = new ContactPhone([
                'desc_tel'     => $request['desc_tel'],
                'numero_tel'         => $request['numero_tel'],
                'contacto_id'   => $contact->id
            ]);
            $contact_tel -> save();

            $contact_social = new ContactSocial([
                'red_social_nombre' => $request['red_social_nombre'],
                'url'               => $request['url'],
                'contacto_id'       => $contact->id
            ]);
            $contact_social -> save();

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
