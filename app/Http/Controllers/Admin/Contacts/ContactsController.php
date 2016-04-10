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
use Illuminate\Support\Facades\DB;
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

        if($contacto[0]->id === $user->contacto_id)
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

            DB::beginTransaction();
            try {
                // Validar si se inserto una imagen si no es asi la imagen guardad sera unknow por default
                $foto = 'unknow.png';
                if ($request->file('foto')) {
                    // Guardar la nueva imagen en la carpeta photo_perfil
                    $foto = 'contact-' . $request->nombre . '_' . $request->ap_paterno . '_' . $request->ap_materno . '_' . Carbon::now()->second . $request->file('foto')->getClientOriginalName();
                    \Storage::disk('photo')->put($foto, \File::get($request->file('foto')));
                }

                // Contacto a registrar
                $contact = new Contacto();
                $contact->fill($request->all());
                $contact->foto = $foto;
                $contact->estado = 'iniciado';
                $contact->save();

                // Guardar direccion o direcciones del contacto
                for ($i = 0; $i < count($request->desc_dir); $i++) {
                    $contact_dir = new ContactAddress([
                        "desc_dir" => $request->desc_dir[$i],
                        "calle" => $request->calle[$i],
                        "numero_dir" => $request->numero_dir[$i],
                        "piso_edificio" => $request->piso_edificio[$i],
                        "ciudad" => $request->ciudad[$i],
                        "cp" => $request->cp[$i],
                        "estado_dir" => $request->estado_dir[$i],
                        "pais" => $request->pais[$i],
                        "contacto_id" => $contact->id
                    ]);
                    $contact_dir->save();
                }

                // Guardar mail o mails del contacto
                for ($i = 0; $i < count($request->desc_mail); $i++) {
                    $contact_mail = new ContactMail([
                        'desc_mail' => $request->desc_mail[$i],
                        'email' => $request->email[$i],
                        'contacto_id' => $contact->id
                    ]);
                    $contact_mail->save();
                }

                // Guardar telefono o telefonos del contacto
                for ($i = 0; $i < count($request->desc_tel); $i++) {
                    $contact_tel = new ContactPhone([
                        'desc_tel' => $request->desc_tel[$i],
                        'numero_tel' => $request->numero_tel[$i],
                        'contacto_id' => $contact->id
                    ]);
                    $contact_tel->save();
                }

                // Guardar red social o redes sociales del contacto
                for ($i = 0; $i < count($request->red_social_nombre); $i++) {
                    $contact_social = new ContactSocial([
                        'red_social_nombre' => $request->red_social_nombre[$i],
                        'url' => $request->url[$i],
                        'contacto_id' => $contact->id
                    ]);
                    $contact_social->save();
                }

                // Contacto a guardar en agenda
                $agenda = new UserHasAgendaContactos([
                    'users_id' => \Auth::user()->id,
                    'contacto_id' => $contact->id
                ]);
                $agenda->save();

                DB::commit();
                return response()->json([
                    'contacto' => $contact,
                    'message' => "Contacto registrado."
                ]);

            } catch (\Exception $e) {
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
        if ($request->ajax()) {
            $contacto = Core::getContactInfo($request->id);
            $contactoAddress = Core::getContactAddress($request->id);
            $contactoPhone = Core::getContactPhone($request->id);
            $contactoMail = Core::getContactMail($request->id);
            $contactoSocial = Core::getContactSocial($request->id);

            return response()->json([
                'contacto' => $contacto,
                'address'  => $contactoAddress,
                'phone'    => $contactoPhone,
                'mail'     => $contactoMail,
                'social'   => $contactoSocial
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                switch ($request->option) {
                    case 1:
                        // Actualizar contacto
                        $contact = Contacto::findOrFail($request->id);
                        $contact->fill($request->all());

                        //Se valida que haya insertado una nueva imagen
                        if ($request->file('foto')) {
                            // Guardar la nueva imagen en el disco
                            $foto = 'contact-' . $request->nombre . '_' . $request->ap_paterno . '_' . $request->ap_materno . '_' . Carbon::now()->second . $request->file('foto')->getClientOriginalName();
                            \Storage::disk('photo')->put($foto, \File::get($request->file('foto')));
                            $contact->foto = $foto;
                        }
                        $contact->save();
                        DB::commit();
                        return response()->json([
                            'message' => "Contacto actualizado.",
                            'contacto' => $contact,
                        ]);
                        break;
                    case 2:
                        //Actualizar direcciones de contacto
                        $i = 0;
                        for ($i; $i < count($request->id); $i++) {
                            $contact_dir = ContactAddress::findOrFail($request->id[$i]);
                            $contact_dir->desc_dir = $request->desc_dir[$i];
                            $contact_dir->calle = $request->calle[$i];
                            $contact_dir->numero_dir = $request->numero_dir[$i];
                            $contact_dir->piso_edificio = $request->piso_edificio[$i];
                            $contact_dir->ciudad = $request->ciudad[$i];
                            $contact_dir->cp = $request->cp[$i];
                            $contact_dir->estado_dir = $request->estado_dir[$i];
                            $contact_dir->pais = $request->pais[$i];
                            $contact_dir->save();
                        }
                        for ($i; $i < count($request->desc_dir); $i++) {
                            $contact_dir = new ContactAddress([
                                "desc_dir" => $request->desc_dir[$i],
                                "calle" => $request->calle[$i],
                                "numero_dir" => $request->numero_dir[$i],
                                "piso_edificio" => $request->piso_edificio[$i],
                                "ciudad" => $request->ciudad[$i],
                                "cp" => $request->cp[$i],
                                "estado_dir" => $request->estado_dir[$i],
                                "pais" => $request->pais[$i],
                                "contacto_id" => $request->contacto_id
                            ]);
                            $contact_dir->save();
                        }
                        DB::commit();
                        return response()->json([
                            'message' => "Dirección actualizada.",
                        ]);
                        break;
                    case 3:
                        //Actualizar telefono de contacto
                        $i = 0;
                        for ($i; $i < count($request->id); $i++) {
                            $contact_tel = ContactPhone::findOrFail($request->id[$i]);
                            $contact_tel->desc_tel = $request->desc_tel[$i];
                            $contact_tel->numero_tel = $request->numero_tel[$i];
                            $contact_tel->save();
                        }
                        for ($i; $i < count($request->desc_tel); $i++) {
                                $contact_tel = new ContactPhone([
                                'desc_tel' => $request->desc_tel[$i],
                                'numero_tel' => $request->numero_tel[$i],
                                'contacto_id' => $request->contacto_id
                            ]);
                            $contact_tel->save();
                        }
                        DB::commit();
                        return response()->json([
                            'message' => "Teléfono actualizado.",
                        ]);
                        break;
                    case 4:
                        // Actualizar mail de contacto
                        $i = 0;
                        for ($i; $i < count($request->id); $i++) {
                            $contact_mail = ContactMail::findOrFail($request->id[$i]);
                            $contact_mail->desc_mail = $request->desc_mail[$i];
                            $contact_mail->email = $request->email[$i];
                            $contact_mail->save();
                        }
                        for ($i; $i < count($request->desc_mail); $i++) {
                            $contact_mail = new ContactMail([
                                'desc_mail' => $request->desc_mail[$i],
                                'email' => $request->email[$i],
                                'contacto_id' => $request->contacto_id
                            ]);
                            $contact_mail->save();
                        }
                        DB::commit();
                        return response()->json([
                            'message' => "Correo actualizado.",
                        ]);
                        break;
                    case 5:
                        // Actualizar redes sociales
                        $i = 0;
                        for ($i; $i < count($request->id); $i++) {
                            $contact_social = ContactSocial::findOrFail($request->id[$i]);
                            $contact_social->red_social_nombre = $request->red_social_nombre[$i];
                            $contact_social->url = $request->url[$i];
                            $contact_social->save();
                        }
                        for($i; $i < count($request->red_social_nombre); $i++) {
                            $contact_social = new ContactSocial([
                                'red_social_nombre' => $request->red_social_nombre[$i],
                                'url' => $request->url[$i],
                                'contacto_id' => $request->contacto_id
                            ]);
                            $contact_social->save();
                        }
                        DB::commit();
                        return response()->json([
                            'message' => "Red social actualizada.",
                        ]);
                        break;
                    default:
                        DB::rollback();
                        return response()->json([
                            'error' => "Ocurrio un problema."
                        ]);
                }
            } catch (\Exception $e) {
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
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
        {
            DB::beginTransaction();
            try {

                $idAddress = DB::table('contact_address')->where('contacto_id', $request->id)->select('id')->get();
                if (!$idAddress == null) {
                    foreach ($idAddress as $id) {
                        ContactAddress::destroy($id->id);
                    }
                }

                $idPhone = DB::table('contact_phone')->where('contacto_id', $request->id)->select('id')->get();
                if (!$idPhone == null) {
                    foreach ($idPhone as $id) {
                        ContactPhone::destroy($id->id);
                    }
                }

                $idMail = DB::table('contact_mail')->where('contacto_id', $request->id)->select('id')->get();
                if (!$idMail == null) {
                    foreach ($idMail as $id) {
                        ContactMail::destroy($id->id);
                    }
                }

                $idSocial = DB::table('contact_social')->where('contacto_id', $request->id)->select('id')->get();
                if (!$idSocial == null) {
                    foreach ($idSocial as $id) {
                        ContactSocial::destroy($id->id);
                    }
                }

                $idAgenda = UserHasAgendaContactos::where('users_id', \Auth::user()->id)->where('contacto_id', $request->id);
                $idAgenda->delete();

                $contact = Contacto::findOrFail($request->id);
                $contact->delete();

                DB::commit();
                return response()->json([
                    'message' => "Contacto eliminado.",
                    'remove' => $request->id
                ]);
            } catch (\Exception $e) {
                DB::rollback();

                return response()->json([
                    'error' => 'Ocurrio un error.',
                    'case' => $e
                ]);
            }
        }
            abort(404);
    }
}
