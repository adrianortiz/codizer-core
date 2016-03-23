<?php
/**
 * User: Codizer
 * Date: 3/3/16
 * Time: 9:53 AM
 */

namespace App\Components;

use App\Empresa;
use App\Perfil;
use App\Contacto;
use App\User;
use App\UserHasPerfil;
use Illuminate\Support\Facades\DB;

class Core
{
    /**
     * Valida que la ruta del perfil exista
     * en la base de datos
     *
     * @param $nameFirstName
     * @return mixed
     */
    public function isRouteValid($nameFirstName)
    {
        $existeRuta = Perfil::where('perfil_route', $nameFirstName)->count();
        if (!$existeRuta == 1) {
            abort(404);
        }
    }

    /**
     * Getter para obtener el perfil de una cuenta
     *
     * @param $nameFirstName
     * @return mixed
     */
    public function getPerfil($nameFirstName)
    {
        return Perfil::where('perfil_route', $nameFirstName)->get();
    }

    /**
     * Getter para obtener el contacto de un perfil
     *
     * @param $perfil
     * @return mixed
     */
    public function getContact($perfil)
    {
        $userHasPerfil = UserHasPerfil::where('perfil_id', $perfil[0]->id)->get();
        return Contacto::where('id', $userHasPerfil[0]->users_id)->get();
    }

    /**
     * Getter para obtener el perfil de un usuario logueado
     * @return mixed
     */
    public function  getUserPerfil()
    {
        $userHasPerfil = UserHasPerfil::where('users_id', \Auth::user()->id)->get();
        return Perfil::where('id', $userHasPerfil[0]->perfil_id)->get();
    }

    /**
     * Getter para obtener los datos de un usuario logueado
     * @return mixed
     */
    public function getUserContact()
    {
        return Contacto::where('id', \Auth::user()->id)->get();
    }

    /**
     * Get all users, profiles and contacts
     * Where the name or last-name is
     * equals to $searh
     *
     * @param $searh String
     * @return mixed
     */
    public function searchGlobal($searh) {
        return DB::table('users')
            ->join('contacto', 'users.id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'users_has_perfil.perfil_id', '=', 'perfil.id')
            ->where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'LIKE', '%'.$searh.'%')
            ->select('contacto.*', 'perfil.perfil_route')
            ->get();
    }

    /**
     * Get all contacts that one user has inserted
     *
     * @return mixed
     */
    public function getContactos($contacto){
        return Contacto::join('users_has_agenda_contactos', 'users_has_agenda_contactos.contacto_id', '=', 'contacto.id')
            ->where('users_id', '=',  $contacto[0]->id)
            ->select('contacto.*')
            ->get();
    }

    /**
     * Get all friends that one user has added
     *
     * @param $contacto
     * @return mixed
     */
    public function getAmigos($contacto){
        return Contacto::join('users', 'users.id', '=', 'contacto.id')
            ->join('users_has_friend_users', 'users_has_friend_users.users_id_friend', '=', 'contacto.id')
            ->where('users_id', '=', $contacto[0]->id)
            ->select('contacto.*', 'users.email' , 'users.password', 'users.role')
            ->get();
    }

    /**
     * Get all followers that one user has added
     *
     * @param $contacto
     * @return mixed
     */
    public function getFollowers($contacto){
        return Contacto::join('users', 'users.id', '=', 'contacto.id')
            ->join('users_has_follower_users', 'users_has_follower_users.users_id_followers', '=', 'contacto.id')
            ->where('users_id', '=', $contacto[0]->id)
            ->select('contacto.*', 'users.email' , 'users.password', 'users.role')
            ->get();
    }

    public function hasEmpresa()
    {
        $empresa = Empresa::where('users_id', '=', \Auth::user()->id )-get();

        if ($empresa)
            return $empresa;
        else
            return false;
    }
}