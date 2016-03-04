<?php
/**
 * User: Codizer
 * Date: 3/4/16
 * Time: 1:03 PM
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Data extends Facade
{
    /**
     * Devuelve una instancia de la
     * clase Data (Components)
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'data';
    }
}