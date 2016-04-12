<?php

namespace App\Http\Controllers\Admin\Information;

use App\Facades\Core;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index($nameFirstName)
    {
        Core::isRouteValid($nameFirstName);

        $perfil         = Core::getPerfil($nameFirstName);
        $contacto       = Core::getContact($perfil);
        $userPerfil     = Core::getUserPerfil();
        $userContacto   = Core::getUserContact();


        // Métodos para contactos
        $userView   = User::where('contacto_id', $contacto[0]->id)->first();
        $user       = User::findOrFail(\Auth::user()->id);
        $contacts   = Core::getContactos($user->id);
        $friends    = Core::getAmigos($userView->id);
        $followers  = Core::getFollowers($contacto);

        $contactoInfo = Core::getContactInfo($contacto[0]->id);
        $contactoAddress = Core::getContactAddress($contacto[0]->id);
        $contactoPhone = Core::getContactPhone($contacto[0]->id);
        $contactoMail = Core::getContactMail($contacto[0]->id);
        $contactoSocial = Core::getContactSocial($contacto[0]->id);

        return view('admin.information.information',
            compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers', 'contactoInfo', 'contactoAddress', 'contactoPhone', 'contactoMail', 'contactoSocial'));
    }


}
