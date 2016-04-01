<?php

namespace App\Http\Controllers\Admin\Car;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * @Contructor
     *
     * Para saber si existe una sesión de lo
     * contrario, crear una para car
     */
    public function __construct()
    {
        if(!Session::has('car'))
            Session::put('car', array());
    }

    public function show()
    {
        $car = Session::get('car');

    }
}
