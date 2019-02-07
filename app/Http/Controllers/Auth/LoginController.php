<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Perfil;
use App\UserHasPerfil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        // Identificamos el id del usuario y buscamos su ruta de perfil
        $perfilId = UserHasPerfil::where('users_id',\Auth::user()->id)->value('perfil_id');
        $perfilRoute = Perfil::where('id', $perfilId)->value('perfil_route');

        return route('perfil', array('nick' => $perfilRoute));
    }
}