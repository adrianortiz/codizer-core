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
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

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

        if($contacto[0]->id == \Auth::user()->id)
            return view('admin.contacts.contacts', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers'));
        else
            return Redirect::to('/perfil/'.$nameFirstName);
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

            // Validar si se inserto una imagen si no es asi la imagen guardad sera unknow por default
            $foto = 'unknow.png';
            if ($request->file('foto'))
            {
                // Guardar la nueva imagen en el disco
                $foto = 'contact-' .$request -> nombre. '_' .$request -> ap_paterno. '_' .$request -> ap_materno. '_' .Carbon::now()->second . $request->file('foto')->getClientOriginalName();
                \Storage::disk('photo')->put($foto, \File::get($request->file('foto')));
            }

            // Contacto a registrar
            $contact = new Contacto([
                'foto'          => $foto,
                'nombre'        => $request -> nombre,
                'ap_paterno'    => $request -> ap_paterno,
                'ap_materno'    => $request -> ap_materno,
                'sexo'          => $request -> sexo,
                'f_nacimiento'  => $request -> f_nacimiento,
                'profesion'     => $request -> profesion,
                'estado_civil'  => $request -> estado_civil,
                'estado'        => 'iniciado',
                'desc_contacto' => $request -> desc_contacto
            ]);
            $contact -> save();

            $contact_dir = new ContactAddress([
                'desc_dir'      => $request -> desc_dir,
                'calle'         => $request -> calle,
                'numero_dir'    => $request -> numero_dir,
                'piso_edificio' => $request -> piso_edificio,
                'ciudad'        => $request -> ciudad,
                'cp'            => $request -> cp,
                'estado_dir'    => $request -> estado_dir,
                'pais'          => $request -> pais,
                'contacto_id'   => $contact->id
            ]);
            $contact_dir -> save();

            $contact_mail = new ContactMail([
                'desc_mail'     => $request -> desc_mail,
                'email'         => $request -> email,
                'contacto_id'   => $contact->id
            ]);
            $contact_mail -> save();

            $contact_tel = new ContactPhone([
                'desc_tel'     => $request -> desc_tel,
                'numero_tel'         => $request -> numero_tel,
                'contacto_id'   => $contact->id
            ]);
            $contact_tel -> save();

            $contact_social = new ContactSocial([
                'red_social_nombre' => $request -> red_social_nombre,
                'url'               => $request -> url,
                'contacto_id'       => $contact -> id
            ]);
            $contact_social -> save();

            // Contacto a guardar en agenda
            $agenda = new UserHasAgendaContactos([
                'users_id'      => \Auth::user() -> id,
                'contacto_id'   => $contact -> id
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
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $contacto = Core::getContactInfo($request['id']);

            return response()->json([
                'contacto' => $contacto,
            ]);
        } else {
            abort(404);
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
        if ($request->ajax()) {


            // Contacto a registrar
            $contact = Contacto::findOrFail($request->id);
            $contact->fill($request->all());

            //Se valida que haya insertado una nueva imagen
//            if ($request->file('foto'))
//            {
//                // Guardar la nueva imagen en el disco
//                $foto = 'contact-' .$request -> nombre. '_' .$request -> ap_paterno. '_' .$request -> ap_materno. '_' .Carbon::now()->second . $request->file('foto')->getClientOriginalName();
//                \Storage::disk('photo')->put($foto, \File::get($request->file('foto')));
//                $contact->foto = $foto;
//            }
//            $contact -> save();

            /**
             * Hacer lo mismo para los demas modelo y descomentar el if
             */
            $id = \DB::table('contact_address')->where('contacto_id', $request->id)->select('id')->get();
            $contact_dir = ContactAddress::findOrFail($id[0]->id);
            dd($contact_dir->fill($request->all()));//$contact_dir->save();

            /**
             * De aqui para abajo hace lo mismo que con
             */
            $contact_mail = ContactMail::findOrFail($request->id);
            $contact_mail->fill($request->all());
            $contact_mail -> save();

            $contact_tel = ContactPhone::findOrFail($request->id);
            $contact_tel->fill($request->all());
            $contact_tel -> save();

            $contact_social = ContactSocial([
                'red_social_nombre' => $request -> red_social_nombre,
                'url'               => $request -> url,
                'contacto_id'       => $contact -> id
            ]);
            $contact_social -> save();

            // Contacto a guardar en agenda
            $agenda = new UserHasAgendaContactos([
                'users_id'      => \Auth::user() -> id,
                'contacto_id'   => $contact -> id
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
