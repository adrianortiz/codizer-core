<?php
/**
 * Created by PhpStorm.
 * User: Codizer
 * Date: 2/22/16
 * Time: 6:00 AM
 */

namespace App;

// dd($ruta->toArray());
// dd($ruta[0]->perfil_route);

class Core
{
    /**
     * Valida que la ruta del perfil exista
     * en la base de datos
     *
     * @param $nameFirstName
     * @return mixed
     */
    static  function isRouteValid($nameFirstName) {
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
    static function getPerfil($nameFirstName) {
        return Perfil::where('perfil_route', $nameFirstName)->get();
    }

    /**
     * Getter para obtener el contacto de un perfil
     *
     * @param $perfil
     * @return mixed
     */
    static function getContact($perfil) {
        $userHasPerfil = UserHasPerfil::where('perfil_id', $perfil[0]->id)->get();
        return Contacto::where('id', $userHasPerfil[0]->users_id)->get();
    }


    static function  getUserPerfil() {
        $userHasPerfil = UserHasPerfil::where('users_id', \Auth::user()->id)->get();
        return Perfil::where('id', $userHasPerfil[0]->perfil_id)->get();
    }

    /**
     * Getter para obtener los datos de mi cuenta
     *
     * @return mixed
     */
    static function getUserContact() {
        return Contacto::where('id', \Auth::user()->id)->get();
    }


}