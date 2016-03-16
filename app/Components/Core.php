<?php
/**
 * User: Codizer
 * Date: 3/3/16
 * Time: 9:53 AM
 */

namespace App\Components;

use App\Perfil;
use App\Contacto;
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
     * @param $contacto
     * @return mixed
     */
    public function getContactos($contacto){
        return Contacto::join('users_has_friend_users', 'users_has_friend_users.users_id_friend', '=', 'contacto.id')
            ->where('users_id', '=', $contacto[0]->id)
            ->select('contacto.id', 'foto', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'f_nacimiento', 'profesion', 'estado', 'desc_origen', 'desc_contacto')
            ->get();
    }


}