<?php
/**
 * Created by PhpStorm.
 * User: Codizer
 * Date: 3/3/16
 * Time: 10:06 AM
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class Core extends Facade
{
    /**
     * Devolvera una nueva instancia de la
     * clase CoreGenerator (Components)
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}