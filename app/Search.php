<?php
/**
 * Created by PhpStorm.
 * User: Codizer
 * Date: 2/24/16
 * Time: 5:17 AM
 */

namespace App;


use Illuminate\Support\Facades\DB;

class Search
{
    /**
     * Get all users, profiles and contacts
     * Where the name or last-name is
     * equals to $searh
     *
     * @param $searh String
     * @return mixed
     */
    static function searchGlobal($searh) {
        return DB::table('users')
            ->join('contacto', 'users.id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'users_has_perfil.perfil_id', '=', 'perfil.id')
            ->where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'LIKE', '%'.$searh.'%')
            ->select('contacto.*', 'perfil.perfil_route')
            ->get();
    }
}